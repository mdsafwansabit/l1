@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection
