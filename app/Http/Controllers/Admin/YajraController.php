<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
}
