<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\User;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class YajraController extends Controller
{
    public function getCourseData(Request $request, CourseService $courseService)
    {
        return DataTables::of($courseService->getAdminCourses())
            ->addColumn('instructor_name', fn ($course) => $course->instructor?->name ?? 'Instructor unavailable')
            ->addColumn('category_name', fn ($course) => $course->category?->name ?? 'Category unavailable')
            ->editColumn('course_image', function ($course) {
                return $course->course_image
                    ? '<img src="'.e(asset($course->course_image)).'" alt="'.e($course->course_title).'" width="30" height="30" class="rounded-circle" style="object-fit: cover;">'
                    : '<span class="text-muted">No image</span>';
            })
            ->editColumn('status', fn ($course) => $course->status == 1
                ? '<span class="badge bg-primary">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>')
            ->addColumn('action', fn ($course) => '<a href="'.e(route('admin.courses.show', $course->id)).'" class="text-primary me-2" title="View" aria-label="View course"><i class="bx bxs-show" aria-hidden="true"></i></a> <a href="'.e(route('admin.courses.edit', $course->id)).'" class="text-primary me-2" title="Edit" aria-label="Edit course"><i class="bx bx-edit" aria-hidden="true"></i></a>')
            ->rawColumns(['course_image', 'status', 'action'])
            ->make(true);
    }

    public function getCategoriesData(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select(['id', 'image', 'name', 'status', 'created_at'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('status', function ($category) {
                    if ($category->status == 1) {
                        return '<span class="badge bg-primary" style="text-transform:none;" title="Active">Active</span>';
                    } else {
                        return '<span class="badge bg-danger" style="text-transform:none;" title="Inactive">In-Active</span>';
                    }
                })

                ->editColumn('created_at', function ($category) {
                    return $category->created_at->format('d-m-Y');
                })

                ->addColumn('image', function ($category) {
                    if ($category->image) {
                        $url = asset($category->image);

                        return '<img src="'.$url.'" width="30" height="30" style="object-fit: cover;" class="rounded-circle"/>';
                    } else {
                        return '<span>No Image</span>';
                    }
                })

                ->addColumn('action', function ($category) {
                    $editUrl = route('admin.category.edit', $category->id);

                    $actions = '
                    <a href="'.$editUrl.'" class="text-primary me-2" title="View">
                        <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deleteCategory(this, '.$category->id.')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>
                ';

                    return $actions;
                })

                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
    }

    public function getSubCategoriesData(Request $request)
    {
        if ($request->ajax()) {
            $data = SubCategory::with('category')
                ->select('id', 'category_id', 'name', 'slug', 'created_at')
                ->latest();

            return DataTables::of($data)
                ->editColumn('created_at', fn ($row) => $row->created_at ? $row->created_at->format('d-m-Y') : '-')
                ->addColumn('category', fn ($row) => $row->category ? $row->category->name : '<span class="text-muted">N/A</span>')
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.sub-category.edit', $row->id);

                    return '
                    <a href="'.$editUrl.'" class="text-primary me-2" title="Edit">
                        <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deleteSubCategory('.$row->id.')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>
                ';
                })
                ->rawColumns(['category', 'action'])
                ->make(true);
        }
    }

    public function getBannerData(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::select(['id', 'title', 'image', 'page', 'sort_order', 'status'])
                ->orderBy('sort_order', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($banner) {
                    return $banner->status == 1
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('image', function ($banner) {
                    if ($banner->image) {
                        $url = asset($banner->image);

                        return '<img src="'.$url.'" width="30" height="30" style="object-fit: cover;" class="rounded-circle"/>';
                    }

                    return '<span>No Image</span>';
                })
                ->addColumn('action', function ($banner) {
                    $editUrl = route('admin.banner.edit', $banner->id);

                    return '
                    <a href="'.$editUrl.'" class="text-primary me-2" title="Edit">
                       <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deletebanner(this, '.$banner->id.')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
    }

    public function getBlogData(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::select(['id', 'title', 'slug', 'image', 'author', 'status', 'published_at']);

            if (! $request->filled('order')) {
                $data->latest('id');
            }

            return DataTables::of($data)
                ->editColumn('title', function ($blog) {
                    return '<div class="fw-semibold">'.e($blog->title).'</div>'
                        .'<small class="text-muted">'.e($blog->slug).'</small>';
                })
                ->editColumn('author', fn ($blog) => $blog->author ?: 'Admin')
                ->editColumn('status', function ($blog) {
                    return $blog->status
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('published_at', fn ($blog) => $blog->published_at?->format('M d, Y') ?? 'Not set')
                ->editColumn('image', function ($blog) {
                    if ($blog->image) {
                        return '<img src="'.e(asset($blog->image)).'" alt="'.e($blog->title).'" width="30" height="30" style="object-fit: cover;" class="rounded-circle"/>';
                    }

                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('action', function ($blog) {
                    $editUrl = route('admin.blog.edit', $blog->id);

                    return '
                    <a href="'.e($editUrl).'" class="text-primary me-2" title="Edit">
                        <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deleteBlog(this, '.(int) $blog->id.')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>';
                })
                ->rawColumns(['title', 'image', 'status', 'action'])
                ->make(true);
        }
    }

    public function getInstructorData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'image', 'phone', 'status'])
                ->where('role', 'instructor')
                ->latest();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($instructor) {
                    return $instructor->status == 1
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('image', function ($instructor) {
                    if ($instructor->image) {
                        $url = asset($instructor->image);

                        return '<img src="'.$url.'" width="30" height="30" style="object-fit: cover;" class="rounded-circle"/>';
                    }

                    return '<span>No Image</span>';
                })
                ->addColumn('action', function ($instructor) {
                    $editUrl = route('admin.instructor.edit', $instructor->id);

                    return '
                    <a href="'.$editUrl.'" class="text-primary me-2" title="Edit">
                       <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deleteInstructor(this, '.$instructor->id.')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
    }

    public function getTestimonialData(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::select([
                'id',
                'name',
                'role',
                'quote',
                'rating',
                'image',
                'sort_order',
                'status',
            ])
                ->orderBy('sort_order', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()

                ->editColumn('status', function ($testimonial) {
                    return $testimonial->status == 1
                        ? '<span class="badge bg-primary">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->editColumn('image', function ($testimonial) {
                    if ($testimonial->image) {
                        $url = $testimonial->image_url;

                        return '<img src="'.$url.'"
                        width="40"
                        height="40"
                        style="object-fit: cover;"
                        class="rounded-circle"/>';
                    }

                    return '<span>No Image</span>';
                })

                ->editColumn('quote', function ($testimonial) {
                    return \Illuminate\Support\Str::limit($testimonial->quote, 80);
                })

                ->editColumn('rating', function ($testimonial) {
                    return str_repeat(
                        '<i class="bx bxs-star text-warning"></i>',
                        $testimonial->rating
                    );
                })

                ->addColumn('action', function ($testimonial) {
                    $editUrl = route(
                        'admin.testimonial.edit',
                        $testimonial->id
                    );

                    return '
                    <a href="'.$editUrl.'"
                       class="text-primary me-2"
                       title="Edit">
                        <i class="bx bxs-edit"></i>
                    </a>

                    <a href="javascript:;"
                       onclick="deletetestimonial(this, '.$testimonial->id.')"
                       class="text-danger"
                       title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>';
                })

                ->rawColumns([
                    'image',
                    'status',
                    'rating',
                    'action',
                ])

                ->make(true);
        }
    }
}
