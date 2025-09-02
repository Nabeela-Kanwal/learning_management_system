<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }


    public function index()
    {
        return view('backend.admin.banner.index');
    }

    public function create()
    {
        return view('backend.admin.banner.create');
    }

    public function store(BannerRequest $request)
    {
        $this->bannerService->saveBanner($request->validated(), $request->file('image'));
        return redirect()->route('admin.banner.index')->with('success', 'Banner created successfully.');
    }

    public function update(BannerRequest $request, string $id)
    {
        $this->bannerService->updateBanner($id, $request->validated(), $request->file('image'));
        return redirect()->route('admin.banner.index')->with('success', 'Banner updated successfully.');
    }


    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.admin.banner.edit', compact('banner'));
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return view('backend.admin.banner.index');
    }
}
