<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập admin
     */
    public function showLoginForm()
    {
        return view('admin.login'); 
    }

    /**
     * Xử lý đăng nhập admin
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $credentials['role'] = 'admin'; // Đảm bảo cột role trong DB là 'admin'

            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate(); // Tạo session mới để bảo mật
                return redirect()->route('admin.home'); // Điều hướng sau khi đăng nhập thành công
            }

            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không đúng hoặc bạn không phải admin.',
            ]);
        }

        return view('admin.login');
    }

    /**
     * Đăng xuất admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Sử dụng đúng guard
        $request->session()->invalidate(); // Xoá session hiện tại
        $request->session()->regenerateToken(); // Tạo CSRF token mới
        return redirect()->route('admin.login'); // Quay lại trang đăng nhập
    }
}
