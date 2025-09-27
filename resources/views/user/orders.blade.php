@extends('layouts.app')

@section('content')
<main class="container main-content" style="padding: 30px 0;">
    <div class="section-heading">
        <h2>My Order History</h2>
    </div>

    <div class="card" , class="order-list-card" , style="background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 24px; min-height: 40vh; overflow-x: auto;">
        @if($orders->isEmpty())
        <p>You have not placed any orders yet.</p>
        <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 10px;">Start Shopping</a>
        @else
        <table class="order-table" style="width: 100%; border-collapse: collapse;  ">
            <thead>
                <tr style="border-bottom: 2px solid #eef2f6;">
                    <th style="text-align: left; padding: 12px;">Order ID</th>
                    <th style="text-align: left; padding: 12px;">Date</th>
                    <th style="text-align: right; padding: 12px;">Total</th>
                    <th style="text-align: center; padding: 12px;">Status</th>
                    <th style="text-align: center; padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom: 1px solid #eef2f6;">
                    <td style="padding: 12px; font-weight: 600;">#{{ $order->id }}</td>
                    <td style="padding: 12px;">{{ $order->created_at->format('d M, Y') }}</td>
                    <td style="text-align: right; padding: 12px;">₹{{ number_format($order->total_price, 2) }}</td>
                    <td style="text-align: center; padding: 12px;">
                        <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td style="text-align: center; padding: 12px;">
                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-outline" style="padding: 5px 10px;">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        {{-- Pagination links --}}
        <div style="margin-top: 20px;">
            {{ $orders->links() }}
        </div>
    </div>
</main>
<style>
    /* Status badge styles (reused from admin) */
    .status-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending {
        background-color: #fffbeb;
        color: #f59e0b;
    }

    .status-processing {
        background-color: #e0e7ff;
        color: #4f46e5;
    }

    .status-shipped {
        background-color: #dbeafe;
        color: #3b82f6;
    }

    .status-delivered {
        background-color: #dcfce7;
        color: #22c55e;
    }

    .status-cancelled {
        background-color: #fee2e2;
        color: #ef4444;
    }
</style>
@endsection