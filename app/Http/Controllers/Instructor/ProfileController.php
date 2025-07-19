<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('backend.instructor.profile.index');
    }

    public function update(ProfileRequest $request)
    {
        $instructor = Auth::guard('instructor')->user();

        $instructor->first_name = $request->first_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->gender = $request->gender;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->city = $request->city;
        $instructor->country = $request->country;
        $instructor->country = $request->country;
        $instructor->bio = $request->bio;
        $instructor->experience = $request->experience;

        if ($request->hasFile('image')) {
            if ($instructor->image && file_exists(public_path('images/profile/' . $instructor->image))) {
                unlink(public_path('images/profile/' . $instructor->image));
            }

            $image = $request->file('image');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profile'), $filename);

            $instructor->image = $filename;
        }

        $instructor->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
