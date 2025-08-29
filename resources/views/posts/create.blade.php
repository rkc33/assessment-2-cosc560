@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<h2>Create Post</h2>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
        @error('content') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':'' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Active</label>
        <select name="is_active" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('posts.all') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
