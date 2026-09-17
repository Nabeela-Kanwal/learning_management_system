<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class AboutController extends Controller
{
    public function index()
    {
        $banner = Banner::where('page', 'about')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->latest()
            ->first();

        return view('frontend.about', compact('banner'));
    }
}
