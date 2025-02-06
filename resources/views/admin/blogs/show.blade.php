@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>{{ $blog->title }}</h1>
        <p>{{ $blog->description }}</p>
        <div class="blog-meta">
            <span>Author: {{ $blog->name }}</span> |
            <span>Published at: {{ $blog->created_at->format('d-m-Y') }}</span>
        </div>
    </div>
@endsection
