<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class YajraController extends Controller
{
    public function getcoursesData(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        // Logged-in instructor ID
        $instructorId = Auth::guard('instructor')->id();

        // Fetch Instructor Courses
        $courses = Course::with(['category', 'subcategory'])
            ->where('instructor_id', $instructorId)
            ->select('courses.*');

        return DataTables::of($courses)
            ->addIndexColumn()
            ->addColumn(
                'course_image',
                fn($row) =>
                '<img src="' . ($row->course_image ? asset('uploads/course/' . $row->course_image) : asset('images/default-course.png')) . '" width="60" height="60" class="rounded">'
            )
            ->addColumn('course_name', fn($row) => $row->course_name ?? '-')
            ->addColumn('category', fn($row) => $row->category?->name ?? '-')
            ->addColumn('subcategory', fn($row) => $row->subcategory?->name ?? '-')
            ->addColumn('selling_price', fn($row) => $row->selling_price ?? '-')
            ->addColumn('discount_price', fn($row) => $row->discount_price ?? '-')
            ->addColumn(
                'status',
                fn($row) =>
                $row->status == 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>'
            )
            ->addColumn(
                'action',
                fn($row) =>
                '<a href="' . route('instructor.course.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>
         <button onclick="deletecourse(this, ' . $row->id . ')" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>'
            )
            ->rawColumns(['course_image', 'status', 'action'])
            ->make(true);
    }
}
