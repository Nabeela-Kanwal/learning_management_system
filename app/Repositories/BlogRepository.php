<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    public function getBlogs()
    {
        return Blog::latest()->get();
    }

    public function getBlog($id)
    {
        return Blog::findOrFail($id);
    }

    public function createBlog(array $data)
    {
        return Blog::create($data);
    }

    public function updateBlog(Blog $blog, array $data)
    {
        $blog->update($data);

        return $blog;
    }

    public function deleteBlog($id)
    {
        return $this->getBlog($id)->delete();
    }

    public function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        return Blog::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists();
    }
}
