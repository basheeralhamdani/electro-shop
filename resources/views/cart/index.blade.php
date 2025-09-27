@extends('layouts.app')

@section('content')
<main class="container main-content" style="padding-top: 30px; padding-bottom: 30px;">
    <div class="section-heading">
        <h2>Your Shopping Cart</h2>
    </div>

    @php $stockErrors = session('stock_errors') ?? []; @endphp

    @if(session('error'))
    <div class="alert" style="background-color: #fee2e2; color: #dc3545; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert" style="background-color: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
    @endif

    @if($cartItems->isEmpty())
    <div style="text-align: center; padding: 50px; background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow);">
        <p style="font-size: 1.2rem;">Your cart is empty.</p>
        <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 20px;">Continue Shopping</a>
    </div>
    @else
    <form action="{{ route('cart.updateAll') }}" method="POST">
        @csrf
        @method('PATCH')
        <div style="background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #eef2f6;">
                        <th style="text-align: left; padding: 12px;">Product</th>
                        <th style="text-align: left; padding: 12px;">Price</th>
                        <th style="text-align: center; padding: 12px;">Quantity</th>
                        <th style="text-align: right; padding: 12px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    @php $hasError = isset($stockErrors[$item->id]); @endphp
                    <tr style="border-bottom: 1px solid #eef2f6; {{ $hasError ? 'background-color: rgba(254, 226, 226, 0.5);' : '' }}">
                        <td style="padding: 12px; display: flex; align-items: center; gap: 15px;">
                            <img src="{{ asset('image/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="70" style="border-radius: 8px;">
                            <div>
                                <span>{{ $item->product->name }}</span>
                                <a href="{{ route('cart.remove', $item->id) }}" style="display: block; font-size: 12px; color: #dc3545; text-decoration: none; margin-top: 5px;">Remove</a>
                            </div>
                        </td>
                        <td style="padding: 12px;">₹{{ number_format($item->product->price, 2) }}</td>
                        <td style="padding: 12px; text-align: center;">
                            {{-- The new array-style input --}}
                            <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1"
                                style="width: 70px; text-align: center; padding: 5px; border: 1px solid {{ $hasError ? '#ef4444' : '#ccc' }}; border-radius: 5px;">
                            @if($hasError)
                            <span style="color: #dc3545; font-size: 12px; font-weight: 600; display: block; margin-top: 5px;">
                                @if($stockErrors[$item->id] > 0)
                                Only {{ $stockErrors[$item->id] }} available
                                @else
                                Out of stock!
                                @endif
                            </span>
                            @endif
                        </td>
                        <td style="text-align: right; padding: 12px;">₹{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px; flex-wrap: wrap; gap: 20px;">
                <div>
                    <button type="submit" class="btn btn-secondary">Update Cart</button>
                </div>
                <div style="text-align: right;">
                    <h3 style="font-size: 1.5rem; margin: 0 0 15px 0;">
                        Grand Total:
                        <span style="color: var(--accent);">₹{{ number_format($totalPrice, 2) }}</span>
                    </h3>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </form>
    @endif
</main>
@endsection