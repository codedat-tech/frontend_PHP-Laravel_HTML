<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FrontendBlogController extends Controller
{
    public function index()
    {          //index: Hiển thị danh sách các blog đang active.
        $blogs = Blog::where('status', 1)->get();
        return view('admin.blogs.index', compact('blogs'));
    }
    public function show($id)
    {        //show: Hiển thị chi tiết một bài blog cụ thể.
        $blog = Blog::findOrFail($id);
        dd($blog);   // thêm dòng này để debug
        return view('admin.blogs.show', compact('blog'));
    }
}
