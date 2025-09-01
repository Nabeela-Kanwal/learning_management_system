<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('backend.admin.banner.index');
    }

    public function create()
    {
        return view('backend.admin.banner.create');
    }

    public function edit()
    {
        return view('backend.admin.banner.edit');
    }

    public function destroy()
    {
        return view('backend.admin.banner.index');
    }
}
