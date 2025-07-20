<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function profile()
    {
        $instructor = auth('instructor')->user();
        return view('backend.instructor.profile.index', compact('instructor'));
    }


    public function updateProfile(ProfileRequest $request)
    {
        $this->profileService->updateProfile($request->validated(), $request->file('image'));
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function showPasswordForm()
    {
        $instructor = auth('instructor')->user();
        return view('backend.instructor.profile.password', compact('instructor'));
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $instructor = auth('instructor')->user();
        $this->profileService->updatePassword($instructor, $request->validated());
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}
