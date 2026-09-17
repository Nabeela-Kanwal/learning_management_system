<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:150'],
            'category' => ['nullable', 'integer'],
            'level' => ['nullable', 'in:Beginner,Intermediate,Advanced,All Levels'],
            'sort' => ['nullable', 'in:newest,price-low,price-high,title'],
        ]);

        $query = Course::with(['category', 'instructor'])->where('status', 1);
        $totalCourses = Course::where('status', 1)->count();
        $categories = Category::withPublishedCourses()->orderBy('name')->get();

        if ($search = trim($filters['q'] ?? '')) {
            $query->where(function ($query) use ($search) {
                $query->where('course_title', 'like', '%'.$search.'%')
                    ->orWhere('course_name', 'like', '%'.$search.'%');
            });
        }
        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }
        if (!empty($filters['level'])) {
            $query->where('label', $filters['level']);
        }

        $sort = $filters['sort'] ?? 'newest';
        if (in_array($sort, ['price-low', 'price-high'])) {
            $query->orderByRaw("CAST(COALESCE(NULLIF(discount_price, ''), NULLIF(selling_price, ''), '0') AS DECIMAL(12, 2)) ".($sort === 'price-low' ? 'ASC' : 'DESC'));
        } elseif ($sort === 'title') {
            $query->orderBy('course_title');
        } else {
            $query->latest();
        }

        $courses = $query->orderBy('id')->paginate(9)->withQueryString();

        return view('frontend.courses.index', compact('courses', 'categories', 'totalCourses', 'filters'));
    }
}
