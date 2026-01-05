@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>
    <div><strong>Name:</strong> {{ $order->name }}</div>
    <div><strong>Email:</strong> {{ $order->email }}</div>
    <div><strong>Phone:</strong> {{ $order->phone }}</div>
    <div><strong>Location:</strong> {{ $order->location }}</div>
    <div class="mt-3">
        <h4>Items</h4>
        <table class="table">
            <thead><tr><th>Product</th><th>Qty</th><th>Price</th></tr></thead>
            <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity,2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
