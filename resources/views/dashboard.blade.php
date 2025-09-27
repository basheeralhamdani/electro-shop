@extends('layouts.app')

@section('content')

{{-- The Meta Tag for Redirection --}}
<meta http-equiv="refresh" content="5;url={{ route('home') }}">

<div style="display: flex; justify-content: center; align-items: center; min-height: 60vh; text-align: center;">
    <div>
        <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text);">
            Welcome, {{ Auth::user()->name }}!
        </h1>
        <p style="font-size: 1.2rem; color: var(--muted); margin-top: 10px;">
            You are logged in. Redirecting to the homepage shortly...
        </p>
        
        {{-- Optional: Add a link for users who don't want to wait --}}
        <div style="margin-top: 30px; font-size: 0.9rem;">
            <a href="{{ route('home') }}" style="color: var(--accent);">Go to Homepage Now</a>
        </div>
    </div>
</div>

@endsection