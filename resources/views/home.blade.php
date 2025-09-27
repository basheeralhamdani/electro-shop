{{-- هذا الملف يرث كل محتوى ملف التنسيق الرئيسي --}}
@extends('layouts.app')

{{-- هذا هو المحتوى الذي سيتم وضعه في مكان @yield('content') --}}
@section('content')

<!-- Hero / slider -->
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-slider" aria-hidden="false" id="slider">
      <div class="slide">
        {{-- لاحظ استخدام asset() للصور أيضاً --}}
        <img src="{{ asset('image/pexels-photo-3780681.webp') }}" alt="Hero 1" />
      </div>
      <div class="slide">
        <img src="{{ asset('image/pexels-photo-404280.webp') }}" alt="Hero 2" />
      </div>
      <div class="slide">
        <img src="{{ asset('image/pexels-photo-1229861.webp') }}" alt="Hero 3" />
      </div>
    </div>

    <div class="hero-cta">
      <h1>Quality Electronics, Great Prices</h1>
      <p>Hand-picked products — fast shipping — reliable support.</p>
      <div class="cta-actions">
        <a class="btn btn-primary" href="#products">Shop Now</a>
        <a class="btn" href="#deals">See Deals</a>
      </div>
    </div>
  </div>
</section>

<!-- Products -->
<main class="container main-content">
  <section id="deals" class="section-heading">
    <h2>Top Deals</h2>
    <p>Daily offers and new arrivals</p>
  </section>

  <!-- Filter / Sort Controls -->
  <div class="product-controls container">
    <div class="filters">
      <label for="category">Filter by category:</label>
      <select id="category">
        <option value="all">All</option>
        @foreach ($categories as $category)
        <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="sort">
      <label for="sort">Sort by:</label>
      <select id="sort">
        <option value="default">Default</option>
        <option value="name">Name (A–Z)</option>
        <option value="price-low">Price (Low → High)</option>
        <option value="price-high">Price (High → Low)</option>
      </select>
    </div>
  </div>

  <section id="products" class="product-grid" aria-label="Product list">

    @forelse ($products as $product)
    <article
      class="product"
      {{-- نستخدم optional() هنا للأمان. إذا لم تكن هناك فئة، سيتم وضع قيمة فارغة --}}
      data-category="{{ strtolower(optional($product->category)->name) }}"
      data-price="{{ $product->price }}"
      data-name="{{ $product->name }}">
      <div class="product-media">
        <img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}" />
      </div>
      <div class="product-body">
        <h3>{{ $product->name }}</h3>
        <p class="price">₹{{ number_format($product->price, 2) }}</p>
        <div class="actions">
          <a href="{{ route('product.show', $product->id) }}" class="btn-outline">View</a>
          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
            @csrf
            <button type="submit" class="btn-primary">Add to cart</button>
          </form>

        </div>
      </div>
    </article>
    @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
      <p>No products found at the moment.</p>
    </div>
    @endforelse

  </section>

  <!-- Newsletter & CTA -->
  <section class="newsletter">
    <div class="newsletter-inner">
      <h3>Join our newsletter</h3>
      <p>Get special offers and product updates — no spam.</p>
      <form action="#" class="newsletter-form" aria-label="Subscribe">
        <input type="email" placeholder="your@email.com" required />
        <button class="btn-primary">Subscribe</button>
      </form>
    </div>
  </section>
</main>

@endsection