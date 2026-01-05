@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md dark:shadow-lg transition-colors duration-300">
        @if($product->image)
            <div class="overflow-hidden rounded">
                <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-64 object-cover transition-transform duration-500 transform hover:scale-105 mb-4">
            </div>
        @endif
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $product->title }}</h1>
        <div class="text-indigo-600 dark:text-indigo-400 mb-3 font-semibold">৳ {{ number_format($product->price,2) }}</div>
        <div class="mb-4 text-gray-700 dark:text-gray-300">{{ $product->description }}</div>

        <form action="{{ route('cart.add') }}" method="POST">@csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="mb-2">
                <label class="inline-block mr-2">Quantity
                    <input type="number" name="quantity" value="1" class="border rounded px-2 py-1" style="width:80px">
                </label>
            </div>
            <button type="submit" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-transform transform hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 6h13" /></svg>
                <span>Add to cart</span>
            </button>
        </form>
    </div>
</div>
@endsection
