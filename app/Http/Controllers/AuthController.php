<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Designer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==========================
    // Customer Authentication
    // ==========================

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $customer = Customer::where('email', $credentials['email'])->first();

        if (!$customer) {
            return redirect()->route('login')->with('error', 'Invalid email or password');
        }

        if ($customer->status !== 'active') {
            return redirect()->route('login')->with('error', 'Your account has been banned by the admin');
        }

        if (Hash::check($credentials['password'], $customer->password)) {
            Auth::login($customer);
            return redirect()->route('home'); // Redirects to the customer home page
        }

        return redirect()->route('login')->with('error', 'Invalid email or password');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = new Customer();
        $customer->full_name = $validatedData['full_name'];
        $customer->email = $validatedData['email'];
        $customer->phone = $validatedData['phone'];
        $customer->address = $validatedData['address'];
        $customer->password = Hash::make($validatedData['password']);
        $customer->status = 'active';

        if ($customer->save()) {
            return redirect()->route('login')->with('success', 'Registration Successful');
        }

        return redirect()->route('register')->with('error', 'Failed to register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirect to the homepage or any other route after logout
    }

    // ==========================
    // Admin Authentication
    // ==========================

    public function login_admin()
    {
        return view('auth.login_admin');
    }

    public function loginPost_admin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::login($admin);
            return redirect()->route('dashboard');
        }

        return redirect()->route('login_admin')->with('error', 'Login failed');
    }

    // ==========================
    // Designer Authentication
    // ==========================

    public function login_designer()
    {
        return view('auth.login_designer');
    }

    public function loginPost_designer(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $designer = Designer::where('email', $credentials['email'])->first();

        if (!$designer) {
            return redirect()->route('login_designer')->with('error', 'Email không đúng hoặc tài khoản không tồn tại.');
        }

        if ($designer->status !== 'active') {
            return redirect()->route('login_designer')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa.');
        }

        if (Hash::check($credentials['password'], $designer->password)) {
            Auth::login($designer);
            return redirect()->intended(route('designer.designerpage'));
        }

        return redirect()->route('login_designer')->with('error', 'Mật khẩu không đúng.');
    }

    public function register_designer()
    {
        return view('auth.register_designer');
    }

    public function registerPost_designer(Request $request)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:designers',
            'phone' => 'nullable|string|max:15',
            'portfolio' => 'nullable|string|max:255',
            'experienceYear' => 'required|integer|min:0',
            'specialization' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $designer = new Designer();
        $designer->fullName = $validatedData['fullName'];
        $designer->email = $validatedData['email'];
        $designer->phone = $validatedData['phone'];
        $designer->portfolio = $validatedData['portfolio'];
        $designer->experienceYear = $validatedData['experienceYear'];
        $designer->specialization = $validatedData['specialization'];
        $designer->rating = $validatedData['rating'];
        $designer->password = Hash::make($validatedData['password']);
        $designer->status = 'active';

        if ($designer->save()) {
            return redirect()->route('login_designer')->with('success', 'Registration Successful');
        }

        return redirect()->route('register_designer')->with('error', 'Failed to register');
    }
}
