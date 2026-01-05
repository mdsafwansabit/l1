@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Cart</h1>

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        @php $total = 0; @endphp
        <div class="space-y-4">
            @foreach($products as $p)
                @php $qty = $cart[$p->id] ?? 0; $subtotal = $p->price * $qty; $total += $subtotal; @endphp
                <div class="flex items-center justify-between bg-white p-4 rounded shadow">
                    <div>
                        <div class="font-semibold">{{ $p->title }}</div>
                        <div class="text-sm text-gray-600">Qty: {{ $qty }}</div>
                    </div>
                    <div class="text-right">
                        <div>৳ {{ number_format($subtotal,2) }}</div>
                        <form action="{{ route('cart.remove', $p->id) }}" method="POST" class="mt-2">@csrf
                            <button class="text-red-600">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 text-right">Total: <span class="font-semibold">৳ {{ number_format($total,2) }}</span></div>
        <div class="mt-3 text-right">
            <a href="{{ route('checkout.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Checkout</a>
        </div>
    @endif
</div>
@endsection
