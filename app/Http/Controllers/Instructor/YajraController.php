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

            // Logged-in instructor ID
            $instructorId = Auth::guard('instructor')->id();

            // Fetch Instructor Courses
            $courses = Course::with(['category', 'subcategory'])
                ->where('instructor_id', $instructorId)
                ->select('id', 'course_title', 'course_image', 'category_id', 'subcategory_id', 'selling_price', 'discount_price', 'status', 'created_at')
                ->latest();

            return DataTables::of($courses)

                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('Y-m-d') : '-';
                })

                ->addColumn('course_image', function ($row) {
                    $img = $row->course_image
                        ? asset($row->course_image)
                        : asset('images/default-course.png');

                    return '<img src="' . $img . '" width="45" height="45" class="rounded">';
                })

                ->addColumn('category', function ($row) {
                    return $row->category
                        ? $row->category->name
                        : '<span class="text-muted">N/A</span>';
                })

                ->addColumn('subcategory', function ($row) {
                    return $row->subcategory
                        ? $row->subcategory->name
                        : '<span class="text-muted">N/A</span>';
                })

                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('instructor.course.edit', $row->id);

                    return '
                    <a href="' . $editUrl . '" class="text-primary me-2" title="Edit">
                        <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deletecourse(' . $row->id . ')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>
                ';
                })

                ->rawColumns(['course_image', 'category', 'subcategory', 'status', 'action'])
                ->make(true);
        }

        abort(404);
    }
}
