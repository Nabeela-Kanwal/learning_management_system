<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    public function index()
    {
        return view('frontend.instructors.index');
    }
}
