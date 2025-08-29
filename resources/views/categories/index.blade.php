@extends('layouts.app')

@section('title', 'All Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Create Category</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
            <th width="150">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('categories.delete', $category->id) }}" 
                       onclick="return confirm('Are you sure?')" 
                       class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">No categories found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
