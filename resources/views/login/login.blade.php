@extends('layouts.index')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-4">{{ __('Login') }}</h3>

                <!-- Display Error Message -->
                @if (session('error'))
                    <div class="alert alert-danger" style="position: fixed; top: 0; width: 100%; z-index: 1000;">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" class="border p-4 rounded">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group mb-3 text-center">
                        <label class="col-form-label">Login as:</label>
                        <div>
                            <label>
                                <input type="radio" name="role" value="customer" checked> Customer
                            </label>
                            <label>
                                <input type="radio" name="role" value="designer"> Designer
                            </label>
                            <label>
                                <input type="radio" name="role" value="admin"> Admin
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button and Back Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary me-2">Login</button>
                        <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                    </div>

                    <!-- Links for Register and Forget Password -->
                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}">Register</a> | <a href="{{ route('password.forget') }}">Forget
                            Password</a>
                    </div>

                    <!-- Divider with "or" text -->
                    <div class="d-flex align-items-center mt-3">
                        <div class="col-md-5">
                            <hr>
                        </div>
                        <div class="col-md-2 text-center">
                            <p class="m-0"><u>or sign in with</u></p>
                        </div>
                        <div class="col-md-5">
                            <hr>
                        </div>
                    </div>

                    <!-- Sign in with Google Button -->
                    <div class="text-center mt-3">
                        <a href="{{ Route('social.login', 'google') }}"
                            class="btn btn-light border d-flex align-items-center justify-content-center mx-auto"
                            style="color: #4285F4; text-decoration: none; width: 200px;">
                            <i class="ri-google-fill" style="font-size: 1.5em; margin-right: 8px;"></i> Sign in with Google
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
