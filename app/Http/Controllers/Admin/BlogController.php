<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = upload_image($request->file('image'), 'images/blogs');
        }

        Blog::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully.');
    }

    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title'], $blog->id);

        if ($request->hasFile('image')) {
            $data['image'] = upload_image($request->file('image'), 'images/blogs');
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Request $request)
    {
        Blog::findOrFail($request->id)->delete();

        return response()->json(['success' => 'Blog deleted successfully.']);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: Str::random(8);
        $slug = $baseSlug;
        $count = 1;

        while (Blog::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $baseSlug.'-'.$count;
            $count++;
        }

        return $slug;
    }
}
