<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $allCategories = Category::latest()->get();
        return view('backend.admin.categories.index', compact('allCategories'));
    }

    public function create()
    {
        return view('backend.admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->saveCategory($request->validated(), $request->file('image'));
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, string $id)
    {
        $this->categoryService->updateCategory($id, $request->validated(), $request->file('image'));
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['success', 'Category deleted successfully.']);
    }
}
