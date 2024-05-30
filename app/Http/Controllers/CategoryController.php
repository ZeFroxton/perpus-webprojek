<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:5',
        ]);

        //upload image

        //create post
        $category = new Category();
        $category->name = $request->name_category;

        $category->save();
        return $category;

    }
}
