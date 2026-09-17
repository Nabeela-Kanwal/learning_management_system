<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use App\Services\InfoService;

class HomeController extends Controller
{
    public function index(InfoService $infoService)
    {
        $categories = Category::withPublishedCourses()->orderBy('name')->get();
        $banners = Banner::where('page', 'home')->where('status', 1)->orderBy('sort_order')->latest()->get();
        $course = Course::where('status', 1)->get();
        $blogs = Blog::where('status', 1)->latest('published_at')->latest()->take(6)->get();
        return view('frontend.home', [
            'infos' => $infoService->getActiveInfos(),
            'categories' => $categories,
            'banners' => $banners,
            'course' => $course,
            'blogs' => $blogs,
        ]);
    }
}
