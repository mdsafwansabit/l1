@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <div class="mb-3 text-muted">{{ $post->created_at->toDayDateTimeString() }}</div>
    <div class="card"><div class="card-body">{!! nl2br(e($post->body)) !!}</div></div>

    <div class="mt-3">
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('posts.index') }}" class="btn btn-link">Back</a>
    </div>
</div>
@endsection
