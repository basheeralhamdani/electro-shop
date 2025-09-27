@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="page-header">
    <h1>Edit Category: {{ $category->name }}</h1>
</div>
<div class="card">
    @if ($errors->any())
        <div class="alert" style="background-color: #fee2e2; color: #dc3545; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div style="text-align: right; margin-top: 20px;">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
    </form>
</div>

{{-- Re-adding styles for consistency --}}
<style>
    .card label { font-weight: 600; display: block; margin-bottom: 5px; }
    .card input, .card textarea, .card select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
</style>
@endsection