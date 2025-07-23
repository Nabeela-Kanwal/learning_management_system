<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\PasswordUpdateService;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    protected $profileService;
    protected $passwordUpdateService;

    public function __construct(ProfileService $profileService, PasswordUpdateService $passwordUpdateService)
    {
        $this->profileService = $profileService;
        $this->passwordUpdateService = $passwordUpdateService;
    }
    public function profile()
    {
        $admin = auth('admin')->user();
        return view('backend.admin.profile.index', compact('admin'));
    }


    public function updateProfile(ProfileRequest $request)
    {
        $this->profileService->updateUserProfile($request->validated(), $request->file('image'));
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function showPasswordForm()
    {
        $admin = auth('admin')->user();
        return view('backend.admin.profile.password', compact('admin'));
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $admin = auth('admin')->user();
        $this->passwordUpdateService->updateUserPassword($admin, $request->validated());
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}
