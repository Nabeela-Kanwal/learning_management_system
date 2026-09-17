<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withPublishedCourses()
            ->with(['subCategory' => fn ($query) => $query
                ->whereHas('courses', fn ($courses) => $courses->where('status', 1))
                ->withCount(['courses' => fn ($courses) => $courses->where('status', 1)])
                ->orderBy('name')])
            ->orderBy('name')->get();

        return view('frontend.categories.index', compact('categories'));
    }
}
