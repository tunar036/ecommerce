<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.product.formEditProduct',compact('product'));
    }

    public function new ()
    {
        return view('admin.product.formCreateProduct');
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

        $detail['show_slider'] = request()->has('show_slider') ? 1 : 0;
        $detail['show_opportunity'] = request()->has('show_opportunity') ? 1 : 0;
        $detail['show_featured'] = request()->has('show_featured') ? 1 : 0;
        $detail['show_bestselling'] = request()->has('show_bestselling') ? 1 : 0;
        $detail['show_discount'] = request()->has('show_discount') ? 1 : 0;

        $product = Product::where('id',$id)->firstOrFail();
        try {
            DB::beginTransaction();
            $product->update($data);
            ProductDetail::updateOrCreate(
                ['product_id' => $product->id],
                    $detail
            );

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

        $detail['show_slider'] = request()->has('show_slider') ? 1 : 0;
        $detail['show_opportunity'] = request()->has('show_opportunity') ? 1 : 0;
        $detail['show_featured'] = request()->has('show_featured') ? 1 : 0;
        $detail['show_bestselling'] = request()->has('show_bestselling') ? 1 : 0;
        $detail['show_discount'] = request()->has('show_discount') ? 1 : 0;
        try {
            DB::beginTransaction();
            $product = Product::create($data);

            $detail['product_id'] = $product->id;
            
            ProductDetail::create($detail);
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
        $product = Product::where('id',$id)->first();
        $product->slug = null;
        $product->save();
        $product->delete();
        ProductDetail::where('product_id',$id)->first()->delete();
        return back()
        ->with('message','Product deleted !')
        ->with('message_type','success');
    }
}
