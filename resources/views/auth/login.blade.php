@extends('layouts.app')

@section('content')
<div class="auth-form-container">
    <div class="auth-form-card">
        <h2>Login to your Account</h2>

        @if (session('status'))
            <div class="alert" style="color: green; margin-bottom: 1rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group" style="display: flex; align-items: center;">
                <input id="remember_me" type="checkbox" name="remember" style="width: auto; margin-right: 8px;">
                <label for="remember_me" style="margin-bottom: 0;">Remember me</label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
        </form>
    </div>
</div>
@endsection