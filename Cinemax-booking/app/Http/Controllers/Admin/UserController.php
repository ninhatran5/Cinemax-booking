<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công');
    }
    public function changeRole($id)
    {
        $user = User::findOrFail($id);

        // Không cho đổi quyền tài khoản admin đầu tiên (ID = 1 hoặc email cụ thể)
        if ($user->id == 1) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Không thể thay đổi quyền của tài khoản admin mặc định');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Đổi vai trò thành công');
    }
}
