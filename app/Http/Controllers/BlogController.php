<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'boolean',
        ]);

        Blog::create($request->all());
        return redirect()->route('blogs.index');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'boolean',
        ]);

        $blog->update($request->all());
        return redirect()->route('blogs.index');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index');
    }
}
