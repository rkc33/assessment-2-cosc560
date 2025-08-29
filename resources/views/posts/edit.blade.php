@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<h2>Edit Post</h2>

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
        @error('content') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected':'' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Active</label>
        <select name="is_active" class="form-control">
            <option value="Yes" {{ $post->is_active == 'Yes' ? 'selected':'' }}>Yes</option>
            <option value="No" {{ $post->is_active == 'No' ? 'selected':'' }}>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('posts.all') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
