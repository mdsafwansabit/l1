@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Edit Product</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-4 bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input name="title" value="{{ old('title', $product->title) }}" required class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (BDT)</label>
            <input name="price" value="{{ old('price', $product->price) }}" type="number" step="0.01" required class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL (CDN)</label>
            <input name="image" value="{{ old('image', $product->image) }}" type="text" placeholder="https://cdn.example.com/image.jpg" class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" class="mt-1 block w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('admin.products.index') }}" class="mr-3 text-gray-600 dark:text-gray-300">Cancel</a>
            <button class="inline-flex items-center px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition">Update</button>
        </div>
    </form>
</div>
@endsection
