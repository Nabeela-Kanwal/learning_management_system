<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

use function PHPUnit\Framework\returnSelf;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        return view('Frontend.category.index', compact('categories'));
    }
}
