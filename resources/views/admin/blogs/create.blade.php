@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1>Create Blog</h1>

        <form action="{{ route('blogs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Blog</button>
        </form>
    </div>
@endsection
