@extends('layouts.index')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <div class="container">
        <h3>Your Profile</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('Asset/Image/designer/' . $designer->image) }}" alt="Profile Image"
                    class="img-fluid rounded-circle mb-3">
            </div>
            <div class="col-md-8">
                <h5>{{ $designer->fullname }}</h5>
                <p><strong>Email:</strong> {{ $designer->email }}</p>
                <p><strong>Phone:</strong> {{ $designer->phone }}</p>
                <p><strong>Address:</strong> {{ $designer->address }}</p>
                <p><strong>Portfolio:</strong> {{ $designer->portfolio }}</p>
                <p><strong>Experience:</strong> {{ $designer->experienceYear }} years</p>
                <p><strong>Specialization:</strong> {{ $designer->specialization }}</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfileModal">
                    Update Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('designers.update', $designer->designerID) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                value="{{ $designer->fullname }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $designer->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $designer->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $designer->address }}" required>
                        </div>
                        <div class="form-group">
                            <label for="portfolio">Portfolio</label>
                            <input type="text" class="form-control" id="portfolio" name="portfolio"
                                value="{{ $designer->portfolio }}">
                        </div>
                        <div class="form-group">
                            <label for="experienceYear">Experience Year</label>
                            <input type="number" class="form-control" id="experienceYear" name="experienceYear"
                                value="{{ $designer->experienceYear }}" required>
                        </div>
                        <div class="form-group">
                            <label for="specialization">Specialization</label>
                            <input type="text" class="form-control" id="specialization" name="specialization"
                                value="{{ $designer->specialization }}">
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection
