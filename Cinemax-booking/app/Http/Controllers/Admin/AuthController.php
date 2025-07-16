<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $credentials['role'] = 'admin';

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('admin.home');
            }

            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không đúng hoặc bạn không phải admin.',
            ]);
        }

        return view('admin.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
