@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<h2>Create Category</h2>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('categories.all') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
