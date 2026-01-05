@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Products</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="p-2">
                <div class="relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-md dark:shadow-lg overflow-hidden transform transition duration-400 hover:scale-105 hover:shadow-2xl">
                    @if($product->image)
                        <div class="card-image overflow-hidden">
                            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-56 object-cover">
                        </div>
                    @else
                        <div class="w-full h-56 bg-gray-100 dark:bg-gray-700"></div>
                    @endif

                    <div class="p-5">
                        <h5 class="font-semibold text-lg text-gray-900 dark:text-gray-100"><a href="{{ route('products.show', $product) }}">{{ $product->title }}</a></h5>
                        <div class="text-indigo-600 dark:text-indigo-400 mt-2 mb-3 font-semibold">৳ {{ number_format($product->price,2) }}</div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($product->description, 100) }}</p>

                        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">@csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white px-4 py-2 rounded-lg transition transform hover:-translate-y-1 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 6h13" /></svg>
                                <span>Add to cart</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
