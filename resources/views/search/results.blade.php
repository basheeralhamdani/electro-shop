@extends('layouts.app')

@section('content')
<main class="container main-content" style="padding-top: 30px;">
    <div class="section-heading">
        <h2>Search Results for "{{ $query }}"</h2>
        <p>{{ $products->total() }} products found.</p>
    </div>

    @if($products->isEmpty())
        <div style="text-align: center; padding: 50px;">
            <p>Sorry, no products matched your search.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
        </div>
    @else
        <section id="products" class="product-grid" aria-label="Product list">
            @foreach ($products as $product)
                <article class="product" data-category="{{ strtolower(optional($product->category)->name) }}" data-price="{{ $product->price }}" data-name="{{ $product->name }}">
                    <div class="product-media">
                        <img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}" />
                    </div>
                    <div class="product-body">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">₹{{ number_format($product->price, 2) }}</p>
                        <p class="desc">{{ Str::limit($product->description, 50) }}</p>
                        <div class="actions">
                            <a href="{{ route('product.show', $product->id) }}" class="btn-outline">View</a>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        {{-- Pagination Links --}}
        <div style="margin-top: 30px; display: flex; justify-content: center;">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif
</main>
@endsection