<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogViewController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)->get(); // Lấy tất cả bài viết đang hoạt động
        return view('blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id); // Lấy bài viết theo ID
        return view('blog.show', compact('blog'));
    }
}
