<?php

namespace App\Http\Controllers\Instructor;

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
                ->where('role', 'instructor')
                ->first();

            if (!$user || $user->status == 0) {
                return back()->with('error', 'Login Failure');
            }

            $credentials = $request->only('email', 'password');
            if (Auth::guard('instructor')->attempt($credentials)) {
                return redirect()->route('instructor.dashboard');
            }

            return back()->with('error', 'Login Failure');
        } else {
            if (auth()->guard('instructor')->check()) {
                if (auth()->guard('instructor')->user()->role == 'instructor') {
                    return redirect()->route('instructor.dashboard');
                } else {
                    return view('backend.instructor.login')->with('error', "You are not logged in as instructor");
                }
            }
            return view('backend.instructor.login');
        }
    }

    public function logout()
    {
        if (Auth::guard('instructor')->check() && Auth::guard('instructor')->user()->role === 'instructor') {
            Auth::guard('instructor')->logout();
            return redirect()->route('instructor.login');
        }
    }
}
