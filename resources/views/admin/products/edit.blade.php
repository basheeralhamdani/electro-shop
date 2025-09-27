@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="page-header">
    <h1>Edit Product: {{ $product->name }}</h1>
</div>

<div class="card">
    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #dc3545; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Important: Use PUT/PATCH for updates --}}
        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            <div>
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label for="price">Price (₹)</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required>
            </div>

<div>
    <label for="stock">Stock Quantity</label>
    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
</div>
            <div>
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="image">Product Image (Leave empty to keep current image)</label>
                <input type="file" id="image" name="image">
                @if($product->image)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('image/' . $product->image) }}" alt="Current Image" width="100">
                    </div>
                @endif
            </div>

            <div style="text-align: right;">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </div>
    </form>
</div>

{{-- Add some basic styling to make the form look good like the create form --}}
<style>
    .card label { font-weight: 600; display: block; margin-bottom: 5px; }
    .card input, .card textarea, .card select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
    .card select { background: white; }
</style>
@endsection