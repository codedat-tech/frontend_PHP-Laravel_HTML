<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Designer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\console;

class AuthController extends Controller
{
    // 1. login
    public function login()
    {
        return view('login.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' => 'required|string|in:customer,designer,admin', // Validate role
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        // Tìm kiếm người dùng theo vai trò
        switch ($role) {
            case 'admin':
                $user = Admin::where('email', $credentials['email'])->first();
                break;
            case 'designer':
                $user = Designer::where('email', $credentials['email'])->first();
                break;
            case 'customer':
            default:
                $user = Customer::where('email', $credentials['email'])->first();
                break;
        }

        // Kiểm tra nếu người dùng tồn tại
        if ($user) {
            // Kiểm tra trạng thái tài khoản
            if ($role === 'customer' && $user->status === '0') {
                return redirect()->route('login')->with('error', 'Your account has been banned by the admin');
            }
            if ($role === 'designer' && $user->status === '0') {
                return redirect()->route('login')->with('error', 'Your account has been banned by the admin');
            }

            // Kiểm tra mật khẩu
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                return redirect()->route($role === 'admin' ? 'dashboard' : ($role === 'designer' ? 'designer.show' : 'index'));
            }
        }

        return redirect()->route('login')->with('error', 'Invalid email or password');
    }

    // 1.2 logout view
    public function logout(Request $request)
    {
        // Ghi log thông tin người dùng trước khi đăng xuất
        if (Auth::check()) {
            Log::info('User  ' . Auth::user()->email . ' is logging out.');
        } else {
            Log::info('No user is currently logged in.');
        }

        // Đăng xuất người dùng
        Auth::logout();

        // Hủy session để đảm bảo an toàn khi đăng xuất
        $request->session()->invalidate();

        // Tạo lại token CSRF để bảo vệ khỏi các cuộc tấn công CSRF
        $request->session()->regenerateToken();

        // Ghi log thông báo đăng xuất thành công
        Log::info('User  has been logged out successfully.');

        // Chuyển hướng về trang index với thông báo
        return redirect()->route('index')->with('status', 'You have been logged out.');
    }
    // 2. register
    public function register()
    {
        return view('login.register');
    }
    // 2.1 show registration
    public function registerPost(Request $request)
    {
        try {
            // Validate chung cho Customer
            $validatedData = $request->validate([
                'fullname' => 'required|string|min:5|max:50',
                'email' => 'required|string|email|max:50|unique:customers,email',
                'password' => 'required|string|min:8|confirmed',
                'address' => 'required|string|min:3|max:255',
                'phone' => 'required|string|min:10|max:20',
            ]);

            // Tạo mới Customer
            $user = new Customer();
            $user->fullname = $validatedData['fullname'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->address = $validatedData['address'];
            $user->phone = $validatedData['phone'];

            if (!$user->save()) {
                return redirect()->route('login/register')->with('error', 'Failed to register');
            }

            //người dùng chọn "Register as Designer"
            if ($request->has('isDesigner')) {
                // Validate riêng cho Designer
                $designerValidatedData = $request->validate([
                    'portfolio' => 'nullable|file|mimes:pdf|max:2048',
                    'experienceYear' => 'required|integer',
                    'specialization' => 'required|string|max:255',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                // Xử lý file portfolio
                if ($request->hasFile('portfolio') && $request->file('portfolio')->isValid()) {
                    $portfolioFile = $request->file('portfolio');
                    $portfolioFileName = time() . '_' . $portfolioFile->getClientOriginalName();
                    $portfolioFile->move(public_path('Asset/PDF/portfolio'), $portfolioFileName);
                }

                // Xử lý file image
                if ($request->hasFile('image')) {
                    $imageFile = $request->file('image');
                    $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
                    $imageFile->move(public_path('Asset/Image/designer'), $imageFileName);
                }

                // Tạo mới Designer
                Designer::create([
                    'fullname' => $validatedData['fullname'],
                    'email' => $validatedData['email'],
                    'password' => $user->password,
                    'portfolio' => isset($portfolioFileName) ? $portfolioFileName : null,
                    'experienceYear' => $designerValidatedData['experienceYear'],
                    'specialization' => $designerValidatedData['specialization'],
                    'image' => isset($imageFileName) ? $imageFileName : null,
                ]);
            }

            return redirect()->route('login')->with('status', 'Registration successful');
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'Failed to register: ' . $e->getMessage());
        }
    }

    // ==========================
    // II. Forget Password
    // ==========================

    // 1. show form
    public function showForgetPasswordForm()
    {
        return view('email');  // Typically the forget password form view
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // 2. reset password
    public function showResetPasswordForm($token)
    {
        return view('reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        //designer
        $designer = Designer::where('email', $credentials['email'])->first();
        if ($designer) {
            if ($designer->status === '0') {
                return redirect()->route('login')->with('error', 'Your designer account has been deactivated.');
            }

            //designer
            $designer->forceFill([
                'password' => Hash::make($credentials['password']),
                'remember_token' => Str::random(60)
            ])->save();

            return redirect()->route('login')->with('status', 'Password reset successfully for designer account.');
        }

        // customer
        $customer = Customer::where('email', $credentials['email'])->first();
        if ($customer) {
            if ($customer->status === '0') {
                return redirect()->route('login')->with('error', 'Your customer account has been banned by the admin.');
            }

            //customer
            $customer->forceFill([
                'password' => Hash::make($credentials['password']),
                'remember_token' => Str::random(60)
            ])->save();

            return redirect()->route('login')->with('status', 'Password reset successfully for customer account.');
        }

        //error
        return redirect()->route('login')->with('error', 'Invalid email or password.');
    }
}
