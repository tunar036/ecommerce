<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->filled('search'))
        {
            request()->flash();
            $search = request('search');
            $list = Category::where('name','like',"%$search%")
            ->orderByDesc('created_at')
            ->paginate(8)
            ->appends('search',$search);
        }else{
        $list = Category::orderByDesc('created_at')->paginate(8);
        }
        return view('admin.category.index', compact('list'));
    }
}
