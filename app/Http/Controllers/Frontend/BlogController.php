<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)
            ->latest('published_at')
            ->latest()
            ->get();
        $course = Course::where('status', 1)->latest()->get();

        return view('frontend.blogs.index', compact('blogs', 'course'));
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        $recentBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->latest()
            ->take(4)
            ->get();
        $course = Course::where('status', 1)->latest()->get();

        return view('frontend.blogs.show', compact('blog', 'recentBlogs', 'course'));
    }
}
