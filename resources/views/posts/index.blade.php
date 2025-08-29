@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Posts</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create Post</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>User</th>
            <th>Status</th>
            <th>Created At</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name ?? '-' }}</td>
                <td>{{ $post->user->name ?? '-' }}</td>
                <td>
                    <span class="badge {{ $post->is_active == 'Yes' ? 'bg-success' : 'bg-danger' }}">
                        {{ $post->is_active }}
                    </span>
                </td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('posts.delete', $post->id) }}" 
                       onclick="return confirm('Are you sure?')" 
                       class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">No posts found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
