@extends('layouts.app')
@section('content')
<main class="container main-content" style="padding: 30px 0;">
    <div class="section-heading"><h2>Checkout</h2></div>
    <div class="checkout-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <div class="card" style="background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px;">
            <h3>Shipping Information</h3>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="form-group"><label>Full Name</label><input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required></div>
                <div class="form-group"><label>Address</label><input type="text" name="address" required></div>
                <div class="form-group"><label>City</label><input type="text" name="city" required></div>
                <div class="form-group"><label>Postal Code</label><input type="text" name="postal_code" required></div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Place Order</button>
            </form>
        </div>
        <div class="card" style="background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px;">
            <h3>Order Summary</h3>
            @foreach($cartItems as $item)
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding: 10px 0;">
                    <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                    <strong>₹{{ number_format($item->product->price * $item->quantity, 2) }}</strong>
                </div>
            @endforeach
            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 20px;">
                <h4>Grand Total</h4>
                <h3>₹{{ number_format($totalPrice, 2) }}</h3>
            </div>
        </div>
    </div>
</main>
<style>.form-group{margin-bottom:15px;} .form-group label{display:block;margin-bottom:5px;font-weight:600;} .form-group input{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;}</style>
@endsection