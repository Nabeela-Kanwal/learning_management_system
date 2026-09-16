<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Course;
use App\Models\User;

class InstructorController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'instructor')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->latest()
            ->first();

        $instructors = User::withCount(['courses' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('role', 'instructor')
            ->latest()
            ->get();

        $course = Course::where('status', 1)->latest()->get();

        return view('frontend.instructors.index', compact('banner', 'instructors', 'course'));
    }
}
