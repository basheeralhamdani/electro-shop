@extends('layouts.app')

@section('content')
<main class="container main-content" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="product-details-grid">
        <!-- Product Image -->
        <div class="product-image-container"><img src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}"></div>
        <!-- Product Info -->
        <div class="product-info-container">
            <a href="#" class="product-category">{{ $product->category->name }}</a>
            <h1>{{ $product->name }}</h1>

            {{-- Star Rating Display --}}
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <ion-icon name="{{ $i <= round($averageRating) ? 'star' : 'star-outline' }}"></ion-icon>
                    @endfor
                    <span>{{ number_format($averageRating, 1) }} ({{ $product->reviews->count() }} reviews)</span>
            </div>

            <p class="product-price">₹{{ number_format($product->price, 2) }}</p>
            <p class="product-description">{{ $product->description }}</p>

            @if($product->stock > 0)
            <span class="stock-badge in-stock">In Stock ({{ $product->stock }} available)</span>
            @else
            <span class="stock-badge out-of-stock">Out of Stock</span>
            @endif
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                @csrf
                <button type="submit" class="btn btn-primary" @if($product->stock <= 0) disabled @endif>
                        <ion-icon name="cart-outline"></ion-icon>
                        {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                </button>
            </form>
        </div>
    </div>

    {{-- Reviews Section --}}
    <div class="reviews-section card">
        <h2>Customer Reviews</h2>
        @auth
        <div class="review-form-container">
            <h4>Leave a Review</h4>
            <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                @csrf
                <div class="form-group star-rating-input">
                    <label>Your Rating</label>
                    <div>
                        <input type="radio" id="rating5" name="rating" value="5" /><label for="rating5"></label>
                        <input type="radio" id="rating4" name="rating" value="4" /><label for="rating4"></label>
                        <input type="radio" id="rating3" name="rating" value="3" /><label for="rating3"></label>
                        <input type="radio" id="rating2" name="rating" value="2" /><label for="rating2"></label>
                        <input type="radio" id="rating1" name="rating" value="1" required /><label for="rating1"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Your Comment</label>
                    <textarea name="comment" id="comment" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
        @else
        <p><a href="{{ route('login') }}">Log in</a> to leave a review.</p>
        @endauth

        <hr>

        <div class="review-list">
            @forelse($product->reviews as $review)
            <div class="review-item">
                <div class="review-header">
                    <strong>{{ $review->user->name }}</strong>
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++) <ion-icon name="{{ $i <= $review->rating ? 'star' : 'star-outline' }}"></ion-icon> @endfor
                    </div>
                </div>
                <p class="review-comment">{{ $review->comment }}</p>
                <small class="review-date">{{ $review->created_at->diffForHumans() }}</small>
            </div>
            @empty
            <p>No reviews yet. Be the first to review this product!</p>
            @endforelse
        </div>
    </div>
</main>
<style>
    /* CSS for Reviews and Star Ratings */
    .star-rating {
        display: flex;
        align-items: center;
        gap: 2px;
        color: #f59e0b;
        margin-bottom: 15px;
    }

    .star-rating span {
        color: var(--muted);
        font-size: 14px;
        margin-left: 8px;
    }

    .reviews-section {
        margin-top: 40px;
        background: var(--card);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 30px;
    }

    .reviews-section h2 {
        margin-bottom: 20px;
    }

    .review-form-container {
        margin-bottom: 30px;
    }

    .review-form-container textarea {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .review-list .review-item {
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }

    .review-list .review-item:last-child {
        border-bottom: none;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-comment {
        margin: 0 0 10px 0;
    }

    .review-date {
        color: var(--muted);
        font-size: 12px;
    }

    /* Interactive Star Rating Input */
    .star-rating-input>div {
        display: inline-block;
    }

    .star-rating-input input {
        display: none;
    }

    .star-rating-input label {
        float: right;
        padding: 0 5px;
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star-rating-input input:checked~label,
    .star-rating-input label:hover,
    .star-rating-input label:hover~label {
        color: #f59e0b;
    }

    .stock-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .in-stock {
        background-color: #dcfce7;
        color: #22c55e;
    }

    .out-of-stock {
        background-color: #fee2e2;
        color: #ef4444;
    }

    /* @media (max-width:768px) { */
        .product-image-container {
            width: 100%;
            padding: 10px;
            background: #ffffff;
        }

        .product-image-container img {
            height: 400px;
        }                                                                                                                                                   

    /* } */






    .add-to-cart-form button:disabled {
        background: #ccc;
        cursor: not-allowed;
        box-shadow: none;
    }
</style>
@endsection