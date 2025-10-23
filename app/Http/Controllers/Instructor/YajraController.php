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
        if ($request->ajax()) {
            $instructorId = Auth::guard('instructor')->id();

            $courses = Course::with(['category', 'subcategory'])
                ->where('instructor_id', $instructorId)
                ->select('courses.*');

            return DataTables::of($courses)
                ->addIndexColumn()
                ->addColumn('course_image', function ($row) {
                    $image = $row->course_image ? asset($row->course_image) : asset('images/default-course.png');
                    return '<img src="' . $image . '" width="60" height="60" class="rounded">';
                })
                ->addColumn('category', function ($row) {
                    return $row->category?->name ?? '-';
                })
                ->addColumn('subcategory', function ($row) {
                    return $row->subcategory?->name ?? '-';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('instructor.course.edit', $row->id) . '" class="btn btn-sm btn-primary">
                            <i class="bx bx-edit"></i>
                        </a>
                        <button onclick="deletecourse(this, ' . $row->id . ')" class="btn btn-sm btn-danger">
                            <i class="bx bx-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['course_image', 'status', 'action'])
                ->make(true);
        }

        // If someone hits the route directly (non-AJAX)
        abort(404);
    }
}
