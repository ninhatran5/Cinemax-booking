<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ClientAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('client.block.login-register.login-register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials['role'] = 'user';

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ])->withInput()->with('error', 'Đăng nhập thất bại!');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'Đăng ký và đăng nhập thành công!');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login')->with('success', 'Đăng xuất thành công!');
    }
}
