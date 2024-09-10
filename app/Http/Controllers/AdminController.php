<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin');
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Find the admin by username
        $admin = Admin::where('username', $request->username)->first();
    
        // Check if admin exists and if the password is correct
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Store the username in session
            session(['username' => $admin->username]);
    
            // Redirect to index page
            return redirect()->route('index');
        }
    
        // If login fails, redirect back with error
        return redirect()->back()->withErrors([
            'username' => 'Invalid credentials',
        ]);
    }
    
    
    public function showIndexPage()
    {
        // Check if username is set in session
        if (!session()->has('username')) {
            // Redirect back to login page with error message
            return redirect()->route('admin.login')->with('error', 'Please log in to continue.');
        }
    
        return view('index');
    }
    
    

    public function showWelcomePage()
    {
        return view('welcome');
    }
}
