@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-3">@csrf
        <div>
            <label class="block text-sm">Name</label>
            <input name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm">Email</label>
            <input name="email" type="email" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm">Phone</label>
            <input name="phone" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm">Location</label>
            <textarea name="location" class="w-full border rounded px-3 py-2"></textarea>
        </div>
        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Place order</button>
        </div>
    </form>
</div>
@endsection
