@extends('admin.layouts.app')

@section('title', 'Manage Products')

@section('content')

<div class="page-header">
    <h1>Manage Products</h1>
<a href="{{ route('admin.products.create') }}" class="btn btn-primary">        <ion-icon name="add-outline"></ion-icon>
        Add New Product
    </a>
</div>

<div class="card">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}" width="60" style="border-radius: 8px;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>₹{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="actions">
                        {{-- Edit Button --}}
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary" title="Edit">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </a>
                        
                        {{-- Delete Button --}}
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>
@endsection