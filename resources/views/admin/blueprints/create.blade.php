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

        <!-- Form to Create Design Category -->
        <h2>Create Design Category</h2>
        <form action="{{ route('category-design.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Category Name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>

        <hr>

        <!-- Form to Create Blueprint -->
        <h2>Create Blueprint</h2>
        <form action="{{ route('blueprints.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Blueprint Name" class="form-control" required>
            </div>
            <div class="form-group">
                <textarea name="description" placeholder="Blueprint Description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <select name="categoryDesignID" class="form-control" required>
                    <option value="">Select Design Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->categoryDesignID }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control-file" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success">Create Blueprint</button>
        </form>
        <h2>Available Blueprints</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Blueprint Name</th>
                    <th>Description</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blueprints as $blueprint)
                    <tr>
                        <td>{{ $blueprint->name }}</td>
                        <td>{{ $blueprint->description }}</td>
                        <td>{{ $blueprint->categoryDesign->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>


    </div>
@endsection
