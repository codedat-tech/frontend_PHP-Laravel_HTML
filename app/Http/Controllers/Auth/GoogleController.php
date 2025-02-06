<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser  = Socialite::driver('google')->user();

        // Tìm hoặc tạo người dùng trong cơ sở dữ liệu
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Nếu người dùng chưa tồn tại, tạo mới
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)), // Tạo mật khẩu ngẫu nhiên
            ]);
        }

        // Đăng nhập người dùng
        Auth::login($user);

        // Chuyển hướng đến trang chính
        return redirect()->route('index'); // Thay đổi route theo nhu cầu của bạn
    }
}
