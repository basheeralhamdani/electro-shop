@extends('layouts.app')

@section('content')

<main class="container main-content" style="padding: 30px 0;">
    <div class="orders-page-header">
        <h1>
            Order Details
            <span style="color: var(--muted); font-weight: 500;">#{{ $order->id }}</span>
        </h1>
        <a href="{{ route('user.orders') }}" class="btn btn-secondary">
            <ion-icon name="arrow-back-outline"></ion-icon> Back to My Orders
        </a>
    </div>

    ```
    <div class="orders-details-grid">
        <div class="orders-card">
            <h4>Products Ordered</h4>

            <!-- Table wrapper (scrollable) -->
            <div class="orders-table-wrapper">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>x{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Scroll hint placed OUTSIDE the scrollable area -->
            <div class="orders-scroll-hint">← Scroll →</div>
        </div>


        <div class="orders-card">
            <h4>Order Summary</h4>
            <p><strong>Shipping To:</strong> {{ $order->name }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}, {{ $order->postal_code }}</p>
            <hr style="margin: 15px 0; border-color: #eee;">
            <p>
                <strong>Current Status:</strong>
                <span class="orders-status-badge orders-status-{{ $order->status }}">
                    {{ $order->status }}
                </span>
            </p>
            <p style="margin-top: 20px;">
                <strong>Total Paid:</strong>
                <strong style="font-size: 1.5rem; color: var(--accent);">
                    ₹{{ number_format($order->total_price, 2) }}
                </strong>
            </p>
        </div>
    </div>
    ```

</main>
@endsection