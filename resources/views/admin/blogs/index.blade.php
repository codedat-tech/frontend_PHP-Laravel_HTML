@extends('admin.layout.index')

@section('content')
    <div class="container">
        <h1>Blogs</h1>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create New Blog</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ substr($blog->description, 0, 30) }}...</td>
                        <td>{{ $blog->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-info"
                                onclick="return confirm('Are you sure you want to edit the blog?')">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want delete the blog?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
