@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h2 class="auth-title">Create Account</h2>
        
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Register</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('login') }}" style="font-size: 0.875rem;">Already have an account? Sign in</a>
        </div>
    </div>
</div>
@endsection
