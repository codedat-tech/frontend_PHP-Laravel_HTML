@extends('layouts.index')
@section('content')
    <style>
        /* blog */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .header .title {
            font-size: 36px;
            margin: 0;
        }

        .header .breadcrumb {
            margin-top: 1px;
        }

        .header .breadcrumb a {
            color: #fff;
            text-decoration: none;
            margin-right: 5px;
        }

        .container {
            padding: 5px;
            background-color: #fff;
        }

        .blog-item {
            display: flex;
            margin-bottom: 40px;
        }

        .blog-image img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .blog-details {
            margin-left: 20px;
        }

        .blog-details h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .blog-details .meta {
            margin-bottom: 10px;
            color: #6c757d;
        }

        .blog-details p {
            margin-bottom: 15px;
        }

        .read-more {
            color: #007bff;
            text-decoration: none;
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination a {
            color: #007bff;
            padding: 10px;
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #007bff;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <div class="content" style="padding-top:10px ">
        <div class="header">
            <div class="breadcrumb">
                <a href="#">Home</a> / <span><a href="/blog">My Blog</a></span>
            </div>
        </div>

        <div class="container">
            @foreach ($blogs as $blog)
                <div class="blog-item">
                    <div class="blog-image">
                        <img src="{{ asset('asset/image/' . $blog->image) }}" alt="{{ $blog->title }}">
                    </div>
                    <div class="blog-details">
                        <h3>{{ $blog->title }}</h3>
                        <div class="meta">
                            <span><i class="fa fa-calendar-alt"></i> {{ $blog->created_at->format('d-M-Y') }}</span>
                            <span><i class="fa fa-comments"></i> {{ $blog->comments_count }} Comments</span>
                        </div>
                        <p>{{ $blog->description }}</p>
                        <a class="read-more" href="{{ route('blog.show', $blog->id) }}">Read More <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">&raquo;</a>
        </div>
    </div>
@endsection
