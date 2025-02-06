@extends('layouts.index')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-4">{{ __('Reset Password') }}</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Input -->
                    <div class="form-group row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- New Password Input -->
                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm New Password Input -->
                    <div class="form-group row mb-3">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm New
                            Password</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
