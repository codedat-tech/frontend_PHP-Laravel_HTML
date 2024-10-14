@extends('admin.layout.index')
@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Designers Management</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Portfolio</th>
                    <th>Experience</th>
                    <th>Specialization</th>
                    <th>Rating</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($designers as $designer)
                    <tr>
                        {{-- <td>{{ $designer->designerID }}</td> --}}
                        <td>{{ $designer->fullname }}</td>
                        <td>{{ $designer->email }}</td>
                        <td>{{ $designer->phone }}</td>
                        <td>{{ $designer->portfolio }}</td>
                        <td>{{ $designer->experienceYear }} years</td>
                        <td>{{ $designer->specialization }}</td>
                        <td>{{ $designer->rating }}</td>
                        <td>
                            <img src="{{ asset('Asset/Image/designer/' . $designer->image) }}"
                                alt="{{ $designer->fullname }}" style="width: 100px; height: auto;">
                            <br>

                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editDesigner({{ $designer->designerID }})">Edit</button>

                            <form action="{{ route('designers.destroy', $designer->designerID) }}" method="POST"
                                {{-- class="d-inline-block" --}}style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Edit Designer Modal -->
    <div class="modal fade" id="editDesignerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Designer</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_designerID" name="designerID">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="portfolio">Portfolio</label>
                            <input type="text" class="form-control" id="portfolio" name="portfolio" required>
                        </div>
                        <div class="form-group">
                            <label for="experienceYear">Experience (Years)</label>
                            <input type="number" class="form-control" id="experienceYear" name="experienceYear" required>
                        </div>
                        <div class="form-group">
                            <label for="specialization">Specialization</label>
                            <input type="text" class="form-control" id="specialization" name="specialization" required>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating (0-5)</label>
                            <input type="number" class="form-control" id="rating" name="rating" min="0"
                                max="5" step="0.1" required>
                        </div>
                        <div class="form-group">
                            <label>Current Image:</label><br>
                            <img id="currentImage" src="" alt="" style="width: 300px; height: auto;">
                            <p id="imageName"></p>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload New Image (optional):</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Designer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editDesigner(id) {
            fetch(`/designers/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_designerID').value = data.designerID;
                    document.getElementById('fullname').value = data.fullname;
                    document.getElementById('email').value = data.email;
                    document.getElementById('phone').value = data.phone;
                    document.getElementById('address').value = data.address;
                    document.getElementById('portfolio').value = data.portfolio;
                    document.getElementById('experienceYear').value = data.experienceYear;
                    document.getElementById('specialization').value = data.specialization;
                    document.getElementById('rating').value = data.rating;
                    document.getElementById('currentImage').src = `/Asset/Image/designer/${data.image}`;
                    document.getElementById('imageName').innerText = data.image;
                    document.getElementById('editForm').action = `/designers/${data.designerID}`;
                    $('#editDesignerModal').modal('show');
                });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
@endsection
