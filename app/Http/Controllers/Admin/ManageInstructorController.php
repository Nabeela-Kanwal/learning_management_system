<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorRequest;
use App\Models\User;
use App\Services\InstructorService;
use Illuminate\Http\Request;

class ManageInstructorController extends Controller
{
     protected $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }


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
    public function store(InstructorRequest $request)
    {
        $this->instructorService->saveInstructor($request->validated(), $request->file('image'));
        return redirect()->route('admin.instructor.index')->with('success', 'Instructor created successfully.');
    }


    public function update(InstructorRequest $request, string $id)
    {
        $this->instructorService->updateInstructor($id, $request->validated(), $request->file('image'));
        return redirect()->route('admin.instructor.index')->with('success', 'Instructor updated successfully.');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $instructor = User::findOrFail($id);
        $instructor->delete();

        return response()->json(['success', 'Instructor deleted successfully.']);
    }
}
