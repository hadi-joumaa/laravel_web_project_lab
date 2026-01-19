@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="mb-0">Login</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

                <div class="text-center mb-3">
                    <p>Or login with:</p>
                    <a href="{{ route('google-redirect') }}"
                       class="btn w-100 mb-2 text-white"
                       style="background-color:#6B9071;">
                        <i class="fab fa-google"></i> Login with Google
                    </a>
                </div>

                <div class="text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .card-header {
        background-color: #AEC3B0;
        color: #1f2d1f;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #6B9071;
        border-color: #6B9071;
    }

    .btn-primary:hover {
        background-color: #5a7f64;
        border-color: #5a7f64;
    }
</style>
@endsection
