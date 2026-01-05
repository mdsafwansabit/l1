<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = Product::findMany($productIds);
        return view('cart.index', compact('products', 'cart'));
    }

    public function add(Request $request)
    {
        $data = $request->validate(['product_id' => 'required|integer', 'quantity' => 'nullable|integer|min:1']);
        $id = (string) $data['product_id'];
        $qty = $data['quantity'] ?? 1;
        $cart = session()->get('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + $qty;
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Added to cart.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Removed.');
    }
}
