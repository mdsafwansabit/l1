@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin - Orders</h1>
    <table class="table">
        <thead><tr><th>ID</th><th>Name</th><th>Total</th><th></th></tr></thead>
        <tbody>
        @foreach($orders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->name }}</td>
                <td>${{ number_format($o->total,2) }}</td>
                <td><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-secondary">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
