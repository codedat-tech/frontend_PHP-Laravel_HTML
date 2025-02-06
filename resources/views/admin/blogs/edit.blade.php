@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1>Edit Blog</h1>

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $blog->name) }}" required>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ old('description', $blog->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="1" {{ old('status', $blog->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $blog->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
