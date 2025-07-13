<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $user = User::where('email', $request->email)
                ->where('role', 'admin')
                ->first();

            if (!$user || $user->status == 0) {
                return back()->with('error', 'Login Failure');
            }

            $credentials = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard');
            }

            return back()->with('error', 'Login Failure');
        } else {
            if (auth()->guard('admin')->check()) {
                if (auth()->guard('admin')->user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return view('backend.admin.login')->with('error', "You are not logged in as Admin");
                }
            }
            return view('backend.admin.login');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    }
}
