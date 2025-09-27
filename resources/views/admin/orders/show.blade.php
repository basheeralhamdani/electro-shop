@extends('admin.layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="page-header">
    <h1>Order Details <span style="color: var(--muted); font-weight: 500;">#{{ $order->id }}</span></h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <ion-icon name="arrow-back-outline"></ion-icon> Back to Orders
    </a>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
    <div class="card">
        <h4>Products Ordered</h4>
        <table class="styled-table">
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
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="display: flex; flex-direction: column; gap: 30px;">
        <div class="card">
            <h4>Customer & Shipping</h4>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <hr style="border: 1px solid #eee; margin: 15px 0;">
            <p><strong>Shipping Address:</strong><br>
                {{ $order->name }}<br>
                {{ $order->address }}<br>
                {{ $order->city }}, {{ $order->postal_code }}
            </p>
        </div>
       

<div class="card">
    <h4>Order Summary</h4>
    <p><strong>Total:</strong> <strong style="font-size: 1.5rem; color: var(--accent);">₹{{ number_format($order->total_price, 2) }}</strong></p>
    
    <hr style="border-top: 1px solid #eee; margin: 20px 0;">

    {{-- ADD THE FORM HERE --}}
    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="status" style="font-weight: 600; display: block; margin-bottom: 10px;">Update Order Status</label>
            <select name="status" id="status" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Update Status</button>
    </form>
</div>


    </div>
</div>
<style> /* Reusing status badge styles from index */ </style>
@endsection