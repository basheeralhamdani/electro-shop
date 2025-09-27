@extends('layouts.app')
@section('content')
<main class="container main-content" style="padding: 50px 0; text-align: center;">
    <div style="background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 50px;">
        <ion-icon name="checkmark-circle-outline" style="font-size: 80px; color: #10cab7;"></ion-icon>
        <h1 style="margin-top: 20px;">Thank You For Your Order!</h1>
        <p style="font-size: 1.2rem; color: var(--muted);">Your order has been placed successfully and is being processed.</p>
        <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 30px;">Continue Shopping</a>
    </div>
</main>
@endsection