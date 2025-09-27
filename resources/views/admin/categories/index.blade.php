@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="page-header">
    <h1>Manage Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <ion-icon name="add-outline"></ion-icon> Add New Category
    </a>
</div>

<div class="card">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Product Count</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-secondary" title="Edit">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Warning: Deleting this category will also delete all associated products. Are you sure?')">
                                <ion-icon name="trash-outline"></ion-icon>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection