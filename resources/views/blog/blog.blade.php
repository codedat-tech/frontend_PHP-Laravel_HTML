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

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .sidebar .profile-img {
            width: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .sidebar h1 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .sidebar .bio-text {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .sidebar .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 18px;
        }


        .header {
            background-color: #007bff;
            color: #fff;
            padding: 40px;
            text-align: center;
        }

        .header .title {
            font-size: 36px;
            margin: 0;
        }

        .header .breadcrumb {
            margin-top: 10px;
        }

        .header .breadcrumb a {
            color: #fff;
            text-decoration: none;
            margin-right: 5px;
        }

        .container {
            padding: 40px;
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
    <!-- Content Start -->
    <div class="content">
        <!-- Page Header Start -->
        <div class="header">
            <div class="breadcrumb">
                <a href="#">Home</a> / <span><a href="/blog">My Blog</a></span>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Blog List Start -->
        <div class="container">
            <div class="blog-item">
                <div class="blog-image">
                    <img src="asset/image/blog1.jpg" alt="Modern Living Room Trends">
                </div>
                <div class="blog-details">
                    <h3>Top 5 Modern Living Room Trends for 2024</h3>
                    <div class="meta">
                        <span><i class="fa fa-calendar-alt"></i> 15-Sep-2024</span>
                        <span><i class="fa fa-comments"></i> 10 Comments</span>
                    </div>
                    <p>Discover the latest living room trends for 2024, featuring minimalism, bold colors, and
                        eco-friendly designs...</p>
                    <a class="read-more" href="#">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>

            <div class="blog-item">
                <div class="blog-image">
                    <img src="asset/image/blog2.jpg" alt="DIY Home Decor">
                </div>
                <div class="blog-details">
                    <h3>10 DIY Home Decor Ideas You Can Try Today</h3>
                    <div class="meta">
                        <span><i class="fa fa-calendar-alt"></i> 01-Sep-2024</span>
                        <span><i class="fa fa-comments"></i> 8 Comments</span>
                    </div>
                    <p>Want to spruce up your home? Check out these simple and affordable DIY decor projects that will
                        transform your space...</p>
                    <a class="read-more" href="#">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>

            <div class="blog-item">
                <div class="blog-image">
                    <img src="asset/image/blog3.jpg" alt="Small Space Design Tips">
                </div>
                <div class="blog-details">
                    <h3>Small Space Design Tips: How to Maximize Every Inch</h3>
                    <div class="meta">
                        <span><i class="fa fa-calendar-alt"></i> 25-Aug-2024</span>
                        <span><i class="fa fa-comments"></i> 12 Comments</span>
                    </div>
                    <p>Learn how to make the most of your small spaces with smart storage solutions and clever design
                        tricks...</p>
                    <a class="read-more" href="#">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- Blog List End -->

        <!-- Pagination Start -->
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">&raquo;</a>
        </div>
        <!-- Pagination End -->
    </div>
    <!-- Content End -->

    </div>
@endsection
