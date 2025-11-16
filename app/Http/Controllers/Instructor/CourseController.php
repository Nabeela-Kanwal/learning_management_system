<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use App\Models\User;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    protected $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }


    public function index()
    {
        $instructorId = Auth::guard('instructor')->id();
        $courses = Course::where('instructor_id', $instructorId)->get();
        // dd($courses);
        return view('backend.instructor.courses.index', compact('courses'));
    }


    public function create()
    {

        $categories = Category::all();
        $subcategories = SubCategory::all();
        $instructors = User::where('role', 'instructor')->get();

        return view('backend.instructor.courses.create', compact('categories', 'subcategories', 'instructors'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $instructors = User::where('role', 'instructor')->get();

        return view('backend.instructor.courses.edit', compact('course', 'categories', 'subcategories', 'instructors'));
    }

    public function store(CourseRequest $request)
    {
        $this->courseService->saveCourse($request->validated(), $request->file('course_image'));
        return redirect()->route('instructor.course.index')->with('success', 'Course created successfully.');
    }

    public function update(CourseRequest $request, string $id)
    {
        $this->courseService->updateCourse($id, $request->validated(), $request->file('course_image'));
        return redirect()->route('instructor.course.index')->with('success', 'Course updated successfully.');
    }
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Course deleted successfully.',
        ]);
    }
}
