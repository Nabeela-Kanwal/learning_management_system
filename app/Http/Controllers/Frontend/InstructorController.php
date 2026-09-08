<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = User::withCount(['courses' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('role', 'instructor')
            ->where('status', 1)
            ->latest()
            ->get();

        $course = Course::where('status', 1)->latest()->get();

        return view('frontend.instructors.index', compact('instructors', 'course'));
    }
}
