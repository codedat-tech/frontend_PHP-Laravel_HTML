<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HeaderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('layouts.header', compact('categories'));
    }
    public function showMenu()
    {
        $categories = Category::all();
        return view('layouts.header', compact('categories'));
    }
}
