<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCourseRequest;
use App\Services\CourseService;

class CourseController extends Controller
{
    public function __construct(protected CourseService $courseService) {}

    public function create()
    {
        return view('admin.courses.form', $this->courseService->getAdminFormOptions());
    }

    public function store(AdminCourseRequest $request)
    {
        $course = $this->courseService->saveCourse($request->safe()->except('course_image'), $request->file('course_image'));

        return redirect()->route('admin.courses.show', $course->id)->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        $course = $this->courseService->getAdminCourse($id);

        return view('admin.courses.form', array_merge($this->courseService->getAdminFormOptions(), compact('course')));
    }

    public function update(AdminCourseRequest $request, $id)
    {
        $course = $this->courseService->updateCourse($id, $request->safe()->except('course_image'), $request->file('course_image'));

        return redirect()->route('admin.courses.show', $course->id)->with('success', 'Course updated successfully.');
    }

    public function show($id)
    {
        $course = $this->courseService->getAdminCourse($id);

        return view('admin.courses.show', compact('course'));
    }

    public function index()
    {
        return view('admin.courses.index');
    }
}
