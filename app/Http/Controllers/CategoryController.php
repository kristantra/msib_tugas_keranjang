<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = Category::all();
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $products = Product::where('category_id', $categoryId)->get();
        } else {
            $products = Product::all();
        }

        return view('categories.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'input_nama' => 'required',
            'input_description' => 'required',
        ]);
        $categories = new Category();
        $categories->name = $request->input_nama;
        $categories->description = $request->input_description;
        $categories->save();
        return redirect()->route('products.index')->with('success', 'Categories Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = Category::all();
        $products = $category->products;
        return view('categories.show', compact('categories', 'products'));
    }



    public function edit($id)
    {
        $category = Category::findorFail($id);
        return view('categories.edit', compact('categories'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'input_nama' => 'required',
            'input_description' => 'required',
        ]);
        $categories = Category::findorFail($id);
        $categories->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'categories updated successfully');
    }

    public function destroy($id)
    {
        $categories = Category::findorFail($id);
        $categories->delete();
        return redirect('categories');
    }
}
