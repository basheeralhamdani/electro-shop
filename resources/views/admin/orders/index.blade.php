@extends('admin.layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="page-header">
    <h1>Manage Orders</h1>
</div>

<div class="card">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary" title="View Details">
                            <ion-icon name="eye-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>
{{-- Add some basic styling for the status badge --}}
<style>
    .status-badge { padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-pending { background-color: #fffbeb; color: #f59e0b; }
    .status-shipped { background-color: #dbeafe; color: #3b82f6; }
    .status-delivered { background-color: #dcfce7; color: #22c55e; }
</style>
@endsection