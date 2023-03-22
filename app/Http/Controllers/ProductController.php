<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all(); //passing seluruh categories
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'input_nama' => 'required',
            'input_description' => 'required',
            'input_image' => 'required|image|mimes:jpeg,png,jpg,jpg,gif,svg|max:2048',
            'input_harga' => 'required',
            'input_category' => 'required',
        ]);
        $dir_path = public_path('images');

        $filename = time() . '.' . $request->file('input_image')->getClientOriginalExtension(); //ubah nama random biar tidak nabrak menggunakan timestamp
        $request->file('input_image')->move(public_path('images'), $filename);

        //store eloquent
        $product = new Product();
        $product->name = $request->input_nama;
        $product->description = $request->input_description;
        $product->image = $filename;
        $product->price = $request->input_harga;
        $product->category_id = $request->input_category;


        $product->save();
        return redirect()->route('products.index')->with('success', 'Product Created Successfully.');
    }

    public function show($id)
    {
        $product = Product::findorFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'input_nama' => 'required',
            'input_description' => 'required',
            'input_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'input_harga' => 'required',
            'input_category' => 'required',
        ]);
        $dir_path = public_path('images');
        chmod($dir_path, 0775);
        $product = Product::findorFail($id);

        if ($request->hasFile('input_image')) {
            $imagePath = public_path('images/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $filename = time() . '.' . $request->file('input_image')->getClientOriginalExtension();
            $request->file('input_image')->move(public_path('images'), $filename);
            $product->image = $filename;
        }

        $product->name = $request->input_nama;
        $product->description = $request->input_description;
        $product->price = $request->input_harga;
        $product->category_id = $request->input_category;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findorFail($id);
        if ($product->image) {

            $imagePath = public_path('images/' . $product->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $product->delete();

        return redirect('products');
    }

    public function storeView()
    {
        $products = Product::all();
        return view('store', compact('products'));
    }
}
