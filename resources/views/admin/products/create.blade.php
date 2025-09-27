@extends('admin.layouts.app')

@section('title', 'Add New Product')

@section('content')

<div class="page-header">
    <h1>Add New Product</h1>
</div>

<div class="card">
    {{-- Handle validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: #fee2e2; color: #dc3545; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
            <div>
                <label for="name" style="font-weight: 600; display: block; margin-bottom: 5px;">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
            </div>

            <div>
                <label for="description" style="font-weight: 600; display: block; margin-bottom: 5px;">Description</label>
                <textarea id="description" name="description" rows="4" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="price" style="font-weight: 600; display: block; margin-bottom: 5px;">Price (₹)</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
            </div>

       
<div>
    <label for="stock" style="font-weight: 600; display: block; margin-bottom: 5px;">Stock Quantity</label>
    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
</div>

            <div>
                <label for="category_id" style="font-weight: 600; display: block; margin-bottom: 5px;">Category</label>
                <select id="category_id" name="category_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px; background: white;">
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="image" style="font-weight: 600; display: block; margin-bottom: 5px;">Product Image</label>
                <input type="file" id="image" name="image" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
            </div>

            <div style="text-align: right;">
                 <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                 <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </div>
    </form>
</div>

@endsection