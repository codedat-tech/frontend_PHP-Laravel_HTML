@extends('layouts.index')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">{{ __('Register') }}</h2>

                <form method="POST" action="{{ route('registerPost') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="fullname" class="col-md-4 col-form-label text-md-end">Full Name</label>
                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control" name="fullname"
                                value="{{ old('fullname') }}" required autofocus>
                        </div>
                    </div>
                    {{-- phone --}}
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                        <div class="col-md-6">
                            <input id="phone" type="phone" class="form-control" name="phone"
                                value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    {{-- address fields --}}

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                        <div class="col-md-6">
                            <input id="address" type="address" class="form-control" name="address"
                                value="{{ old('address') }}" size="255" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <!-- Designer fields, initially hidden -->
                    <div id="designerFields" style="display: none;">
                        <div class="row mb-3">
                            <label for="portfolio" class="col-md-4 col-form-label text-md-end">Portfolio PDF</label>
                            <div class="col-md-6">
                                <input id="portfolio" type="file" class="form-control" name="portfolio"
                                    value="{{ old('portfolio') }}">

                            </div>
                        </div>
                        {{-- year --}}
                        <div class="row mb-3">
                            <label for="experienceYear" class="col-md-4 col-form-label text-md-end">Years of
                                Experience</label>
                            <div class="col-md-6">
                                <input id="experienceYear" type="number" class="form-control" name="experienceYear"
                                    value="{{ old('experienceYear') }}" max="10" value="from 1 - 10 year old">
                            </div>
                        </div>
                        {{-- specialization --}}
                        <div class="row mb-3">
                            <label for="specialization" class="col-md-4 col-form-label text-md-end">Specialization</label>
                            <div class="col-md-6">
                                <input id="specialization" type="text" class="form-control" name="specialization"
                                    value="{{ old('specialization') }}" size="255">
                            </div>
                        </div>
                        {{-- image --}}
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image"
                                    value="{{ old('image') }}">
                            </div>
                        </div>

                        <!-- Add other fields for designer as necessary -->
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm
                            Password</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>
                    </div>
                    {{-- neu la designerthif chon --}}
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end">
                            <input type="checkbox" id="isDesigner" name="isDesigner">
                        </div>
                        <label for="isDesigner" class="col-md-6">Register as Designer</label>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary" <button type="submit"
                                onclick="return confirm('Are you sure you want to register?')">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('isDesigner').addEventListener('change', function() {
            const designerFields = document.getElementById('designerFields');
            designerFields.style.display = this.checked ? 'block' : 'none';
        });
    </script>
@endsection
