<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        if(request()->filled('search'))
        {
            request()->flash();
            $search = request('search');
            $list = Category::with('up_category')->where('name','like',"%$search%")
            ->orderByDesc('id')
            ->paginate(8)
            ->appends('search',$search);
        }else{
        $list = Category::with('up_category')->orderByDesc('id')->paginate(8);
        }
        return view('admin.category.index', compact('list'));
    }

    public function edit ($id)
    {
        $category = Category::findOrFail($id);
        $allcategories = Category::all();
        return view ('admin.category.formEditCategory',compact('category','allcategories'));
    }

    public function new()
    {
        $allcategories =Category::all();
        return view('admin.category.formCreateCategory',compact('allcategories'));
    }

    public function update($id)
    {

        $this->validate(request(), [
            'name' => 'required',
            'slug' => 'unique:category,slug,' . $id
        ]);

        $data = request()->only('name', 'slug','up_id');
        
        if(!request()->filled('slug'))
            $data['slug'] = Str::slug(request('name'));
        
        $category = Category::where('id', $id)->firstOrFail();
        $category->update($data);

        return redirect()
            ->route('admin.category.edit', $category->id)
            ->with('message', 'Updated')
            ->with('message_type', 'success');
    }

    public function save()
    {
        $this->validate(request(), [
            'name' => 'required',
            'slug' =>'unique:category,slug|nullable'
        ]);

        $data = request()->only('name', 'slug','up_id');
        

        if(!request()->filled('slug')){
            $data['slug'] = Str::slug(request('name'));
        }

        $checkSlug = Category::where('slug', $data['slug'])->withTrashed()->count();

        if($checkSlug){
            return redirect()
                ->back()
                ->with('message', 'The slug has already been taken.')
                ->with('message_type', 'danger');
        }

        try {
            DB::beginTransaction();

           Category::create($data);

            DB::commit();
        } catch (Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->with('message', $e->getMessage())
                ->with('message_type', 'danger');
        }

        return redirect()
            ->back()
            ->with('message', "Created")
            ->with('message_type', 'success');
    }

    public function delete ($id){
        //Delete products belonging to the category 
        $products_belonging_to_the_category = Category::find($id);
        $products_belonging_to_the_category->products()->detach();
        // //

        $category = Category::where('id',$id)->first();
        $category->slug = null;
        $category->save();

        $category->delete();

        return back()
        ->with('message', "Category deleted")
        ->with('message_type','success');
    }
}
