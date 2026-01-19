@extends('layout.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">

            <!-- Card Header -->
            <div class="card-header text-center"
                 style="background-color:#AEC3B0; color:#1f2d1f;">
                <h4 class="mb-0 fw-semibold">Create Account</h4>
            </div>

            <!-- Card Body -->
            <div class="card-body" style="background-color:#E3EED4;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Enter your name"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Email</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter your email"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-medium">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="Create a password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label class="form-label fw-medium">Confirm Password</label>
                        <input type="password"
                               class="form-control"
                               name="password_confirmation"
                               placeholder="Confirm your password"
                               required>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit"
                                class="btn text-white fw-semibold"
                                style="background-color:#6B9071;">
                            Register
                        </button>
                    </div>
                </form>

                <!-- Login link -->
                <div class="text-center mt-3">
                    <small>
                        Already have an account?
                        <a href="{{ route('login') }}" style="color:#6B9071; font-weight:500;">
                            Login here
                        </a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
