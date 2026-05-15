@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <h2 class="auth-title">Welcome Back</h2>
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"  autofocus>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Sign In</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="{{ route('register') }}" style="font-size: 0.875rem;">Don't have an account? Register</a>
        </div>
    </div>
</div>
@endsection
