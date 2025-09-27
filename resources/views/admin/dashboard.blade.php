@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
</div>

{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #dcfce7;">
            <ion-icon name="wallet-outline" style="color: #22c55e;"></ion-icon>
        </div>
        <div>
            <p class="stat-label">Total Revenue</p>
            <p class="stat-value">₹{{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #dbeafe;">
            <ion-icon name="receipt-outline" style="color: #3b82f6;"></ion-icon>
        </div>
        <div>
            <p class="stat-label">Total Orders</p>
            <p class="stat-value">{{ $totalOrders }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #ede9fe;">
            <ion-icon name="people-outline" style="color: #8b5cf6;"></ion-icon>
        </div>
        <div>
            <p class="stat-label">Total Customers</p>
            <p class="stat-value">{{ $totalCustomers }}</p>
        </div>
    </div>
</div>

{{-- Recent Orders Table --}}
<div class="card" style="margin-top: 30px;">
    <h4>Recent Orders</h4>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestOrders as $order)
                <tr>
                    <td><a href="{{ route('admin.orders.show', $order->id) }}" style="text-decoration: underline; font-weight: 600;">#{{ $order->id }}</a></td>
                    <td>{{ $order->user->name }}</td>
                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                    <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">No recent orders.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<style>
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; }
    .stat-card { display: flex; align-items: center; gap: 20px; background: var(--card); padding: 24px; border-radius: var(--radius); box-shadow: var(--shadow); }
    .stat-icon { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .stat-icon ion-icon { font-size: 24px; }
    .stat-label { margin: 0; color: var(--muted); font-weight: 500; }
    .stat-value { margin: 4px 0 0 0; font-size: 1.75rem; font-weight: 700; }
    .status-badge { padding: 4px 8px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-pending { background-color: #fffbeb; color: #f59e0b; }
    .status-shipped { background-color: #dbeafe; color: #3b82f6; }
    .status-processing { background-color: #e0e7ff; color: #4f46e5; }
    .status-delivered { background-color: #dcfce7; color: #22c55e; }
    .status-cancelled { background-color: #fee2e2; color: #ef4444; }
</style>
@endsection