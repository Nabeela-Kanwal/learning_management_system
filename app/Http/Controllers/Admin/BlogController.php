<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        $blogs = $this->blogService->getBlogs();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        $this->blogService->saveBlog($request->validated(), $request->file('image'));

        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully.');
    }

    public function edit(string $id)
    {
        $blog = $this->blogService->getBlog($id);

        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, string $id)
    {
        $this->blogService->updateBlog($id, $request->validated(), $request->file('image'));

        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Request $request)
    {
        $this->blogService->deleteBlog($request->id);

        return response()->json(['success' => 'Blog deleted successfully.']);
    }
}
