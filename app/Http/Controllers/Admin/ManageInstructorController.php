<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageInstructorController extends Controller
{
    public function index()
    {
        $instructor = User::where('role', 'instructor')->latest()->get();
        // dd($instructor);
        return view('backend.admin.instructor.index', compact('instructor'));
    }
    public function create()
    {
        return view('backend.admin.instructor.create');
    }

    public function edit($id)
    {
        $instructor = User::findOrFail($id);
        return view('backend.admin.instructor.edit', compact('instructor'));
    }
}
