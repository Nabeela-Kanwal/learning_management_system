<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryService;

    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    public function index()
    {
        $allCategories = SubCategory::latest()->get();
        return view('backend.admin.sub-categories.index', compact('allCategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get(); // only active categories
        return view('backend.admin.sub-categories.create', compact('categories'));
    }
    public function store(SubCategoryRequest $request)
    {
        $this->subCategoryService->saveSubCategory($request->validated(), $request->file('image'));
        return redirect()->route('admin.sub-category.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit(string $id)
    {
        $category = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get(); // fetch all active categories

        return view('backend.admin.sub-categories.edit', compact('category', 'categories'));
    }
    public function update(SubCategoryRequest $request, string $id)
    {
        // Pass only the validated data, no image
        $this->subCategoryService->updateSubCategory($id, $request->validated());

        return redirect()->route('admin.sub-category.index')
            ->with('success', 'SubCategory updated successfully.');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = SubCategory::findOrFail($id);
        $category->delete();

        return response()->json(['success', 'Category deleted successfully.']);
    }
}
