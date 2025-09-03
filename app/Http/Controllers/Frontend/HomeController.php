<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $banners = Banner::where('page', 'home')->where('status', 1)->get();
        return view('frontend.home', [
            'categories' => $categories,
            'banners' => $banners,
        ]);
    }
}
