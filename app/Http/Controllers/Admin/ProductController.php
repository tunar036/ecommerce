<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index ()
    {
        if(request()->filled('search')){
            request()->flash();
            $search = request('search');
            $list = Product::where('name','like',"%$search%")
            ->orWhere('desc','like',"%$search%")
            ->orderByDesc('id')
            ->paginate(8);
        }else{
            $list = Product::orderByDesc('id')->paginate(8);
        }
        return view('admin.product.index',compact('list'));
    }

    public function edit($id)
    {   
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $product_categories = $product->categories()->pluck('category_id')->all();
        return view('admin.product.formEditProduct',compact('product','categories','product_categories'));
    }

    public function new ()
    {
        $categories = Category::all();
        return view('admin.product.formCreateProduct',compact('categories'));
    }

    public function update($id)
    {
        // dd(request()->all());
        $this->validate(request(),[
            'name' => 'required',
            'price' => 'required',
            'slug' => 'unique:product,slug,' . $id
        ]);

        $data = request()->only('name','price','slug');
        // dd($data);
        if(!request()->filled('slug')){
            $data['slug'] = Str::slug(request('name'));
        }

        $detail = [
            'show_slider' =>request()->has('show_slider') ? 1 : 0,
            'show_opportunity' =>request()->has('show_opportunity') ? 1 : 0,
            'show_featured' =>request()->has('show_featured') ? 1 : 0,
            'show_bestselling' =>request()->has('show_bestselling') ? 1 : 0,
            'show_discount' =>request()->has('show_discount') ? 1 : 0,
        ];


        $product = Product::where('id',$id)->firstOrFail();
        $categories = request('categories');
        try {
            DB::beginTransaction();
            $product->update($data);
            ProductDetail::updateOrCreate(
                ['product_id' => $product->id],
                    $detail
            );

            $product->categories()->sync($categories);

            if(request()->hasFile('product_image'))
            {
                $this->validate(request(),[
                    'product_image' => 'image|mimes:jpg,png,jpeg,gif|max:2048'
                ]);

                $product_image = request()->file('product_image');
                $file_name = $product->id . '-' . time() . '.' . $product_image->extension();

                if($product_image->isValid())
                {
                    $product_image->move('uploads/products',$file_name);
                    ProductDetail::updateOrCreate(
                        ['product_id'=>$product->id],
                        ['product_image'=>$file_name]
                    );
                }

            }

            DB::commit();
            
        } catch (Exception $e) {
           DB::rollBack();
            return redirect()
            ->back()
            ->with('message', $e->getMessage())
            ->with('message_type', 'danger'); 
        }
        return redirect()
            ->route('admin.product.edit', $product->id)
            ->with('message', 'Updated')
            ->with('message_type', 'success');


    }
    
    public function save ()
    {

        // dd(request()->all());
        // return request()->all();
        $this->validate(request(),[
            'name' => 'required',
            'slug' => 'unique:product,slug|nullable',
            'price' => 'required|numeric'
        ]);

        $data = request()->only('name','slug','desc','price');

        if(!request()->filled('slug')){
            $data['slug'] = Str::slug(request('name'));
        }

        $detail = [
            'show_slider' =>request()->has('show_slider') ? 1 : 0,
            'show_opportunity' =>request()->has('show_opportunity') ? 1 : 0,
            'show_featured' =>request()->has('show_featured') ? 1 : 0,
            'show_bestselling' =>request()->has('show_bestselling') ? 1 : 0,
            'show_discount' =>request()->has('show_discount') ? 1 : 0,
        ];

        $categories = request('categories');

        
        try {
            DB::beginTransaction();
            $product = Product::create($data);

            $detail['product_id'] = $product->id;
            
            ProductDetail::create($detail);

            $product->categories()->attach($categories);
            
            if(request()->hasFile('product_image'))
            {
                $this->validate(request(),[
                    'product_image' =>'image|mimes:jpg,png,jpeg,gif|max:2048'
                ]);
                $product_image = request()->file('product_image');
                $file_name = $product->id . '-' . time() . '.' . $product_image->extension();

                if($product_image->isValid())
                {
                    $product_image->move('uploads/products',$file_name);
                    ProductDetail::updateOrCreate(
                        ['product_id'=>$product->id],
                        ['product_image'=>$file_name]
                    );
                }
            }
            
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()
            ->back()
            ->with('message', $e->getMessage())
            ->with('message_type', 'danger');
        }
        return redirect()
            ->route('admin.product.edit', $product->id)
            ->with('message', 'Product Created')
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        //$product->detail()->delete();
        $product->slug = null;
        $product->save();
        $product->delete();
        return back()
        ->with('message','Product deleted !')
        ->with('message_type','success');
    }
}
