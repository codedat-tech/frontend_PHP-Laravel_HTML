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

        <h2>Blueprint List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    {{-- <th>Name</th> --}}
                    <th>Description</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blueprints as $blueprint)
                    <tr>
                        {{-- <td>{{ $blueprint->name }}</td> --}}
                        <td>{{ $blueprint->description }}</td>
                        <td>{{ $blueprint->categoryDesign->name }}</td>
                        <td>
                            @if ($blueprint->image)
                                <img src="{{ asset('Asset/Image/' . $blueprint->image) }}" alt="{{ $blueprint->name }}"
                                    style="width: 100px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <!-- Edit Button (triggers modal) -->
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $blueprint->blueprintID }}">
                                Edit
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('blueprints.delete', $blueprint->blueprintID) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this blueprint?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $blueprint->blueprintID }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $blueprint->blueprintID }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $blueprint->blueprintID }}">Edit
                                        Blueprint</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('blueprints.update', $blueprint->blueprintID) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $blueprint->name }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" required>{{ $blueprint->description }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select class="form-select" id="category" name="categoryDesignID" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->categoryDesignID }}"
                                                        {{ $blueprint->categoryDesignID == $category->categoryDesignID ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <small class="form-text text-muted">Leave blank if you don't want to update
                                                the image.</small>
                                        </div>

                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS (Ensure you have Bootstrap JS included for the modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
