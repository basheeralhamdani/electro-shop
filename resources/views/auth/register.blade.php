@extends('layouts.app')

@section('content')
<div class="auth-form-container">
    <div class="auth-form-card">
        <h2>Create a New Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                @error('name')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                @error('email')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
                @error('password')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <p class="auth-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('login') }}">
                    Already registered?
                </a>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection