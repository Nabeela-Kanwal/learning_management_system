<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class YajraController extends Controller
{
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
                    return $category->created_at->format('Y-m-d');
                })

                ->addColumn('image', function ($category) {
                    if ($category->image) {
                        $url = asset($category->image);
                        return '<img src="' . $url . '" width="30" height="30" style="object-fit: cover;" class="rounded-circle"/>';
                    } else {
                        return '<span>No Image</span>';
                    }
                })

                ->addColumn('action', function ($category) {
                    $editUrl = route('admin.category.edit', $category->id);

                    $actions = '
                    <a href="' . $editUrl . '" class="text-primary me-2" title="View">
                        <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deleteCategory(this, ' . $category->id . ')" class="text-danger" title="Delete">
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
                ->editColumn('created_at', fn($row) => $row->created_at ? $row->created_at->format('Y-m-d') : '-')
                ->addColumn('category', fn($row) => $row->category ? $row->category->name : '<span class="text-muted">N/A</span>')
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.sub-category.edit', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="text-primary me-2" title="Edit">
                        <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deleteSubCategory(' . $row->id . ')" class="text-danger" title="Delete">
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
            $data = Banner::select(['id', 'title', 'image', 'page', 'sort_order', 'status'])->latest();

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
                        return '<img src="' . $url . '" width="30" height="30" style="object-fit: cover;" class="rounded-circle"/>';
                    }
                    return '<span>No Image</span>';
                })
                ->addColumn('action', function ($banner) {
                    $editUrl = route('admin.banner.edit', $banner->id);
                    return '
                    <a href="' . $editUrl . '" class="text-primary me-2" title="Edit">
                       <i class="bx bxs-show"></i>
                    </a>
                    <a href="javascript:;" onclick="deletebanner(this, ' . $banner->id . ')" class="text-danger" title="Delete">
                        <i class="bx bx-trash"></i>
                    </a>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
    }
}
