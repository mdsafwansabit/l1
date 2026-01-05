<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        $products = Product::findMany(array_keys($cart));
        return view('checkout.create', compact('products', 'cart'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Cart is empty');
        }

        $products = Product::findMany(array_keys($cart));
        $total = 0;
        foreach ($products as $p) {
            $qty = $cart[$p->id] ?? 0;
            $total += $p->price * $qty;
        }

        $order = Order::create(array_merge($data, ['total' => $total]));

        foreach ($products as $p) {
            $qty = $cart[$p->id] ?? 0;
            if ($qty <= 0) continue;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $p->id,
                'quantity' => $qty,
                'price' => $p->price,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Order placed.');
    }
}
