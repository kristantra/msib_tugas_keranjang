<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart(Request $request)
    {

        $request->validate([
            'input_productid' => 'required|exists:products,id',
            'input_quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('input_productid');
        $quantity = $request->input('input_quantity');

        $existingCart = Cart::where('product_id', $productId)->first();
        if ($existingCart) {
            $existingCart->quantity += $quantity;
            $existingCart->save();
        } else {
            $cart = new Cart();
            $cart->product_id = $productId;
            $cart->quantity = $quantity;
            $cart->save();
        }

        return redirect()->back()->with('success', 'Product added to cart succcessfully.');
    }

    public function index()
    {
        $carts = Cart::all();
        return view('carts.index', compact('carts'));
    }

    public function removeFromCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Product removed successfully');
    }
}
