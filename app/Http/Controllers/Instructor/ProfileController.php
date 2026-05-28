<?php

namespace App\Http\Controllers\Instructor;

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
        $instructor = auth('instructor')->user();
        return view('instructor.profile.index', compact('instructor'));
    }


    public function updateProfile(ProfileRequest $request)
    {
        $this->profileService->updateUserProfile($request->validated(), $request->file('image'));
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function showPasswordForm()
    {
        $instructor = auth('instructor')->user();
        return view('instructor.profile.password', compact('instructor'));
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $instructor = auth('instructor')->user();
        $this->passwordUpdateService->updateUserPassword($instructor, $request->validated());
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}
