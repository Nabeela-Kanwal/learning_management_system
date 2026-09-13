<?php

namespace App\Services;

use App\Repositories\BlogRepository;
use Illuminate\Support\Str;

class BlogService
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getBlogs()
    {
        return $this->blogRepository->getBlogs();
    }

    public function getBlog($id)
    {
        return $this->blogRepository->getBlog($id);
    }

    public function saveBlog(array $data, $photo = null)
    {
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);

        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/blogs');
        }

        return $this->blogRepository->createBlog($data);
    }

    public function updateBlog($id, array $data, $photo = null)
    {
        $blog = $this->blogRepository->getBlog($id);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title'], $blog->id);

        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/blogs');
        }

        return $this->blogRepository->updateBlog($blog, $data);
    }

    public function deleteBlog($id)
    {
        return $this->blogRepository->deleteBlog($id);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($value) ?: Str::random(8);
        $slug = $baseSlug;
        $count = 1;

        while ($this->blogRepository->slugExists($slug, $ignoreId)) {
            $slug = $baseSlug.'-'.$count;
            $count++;
        }

        return $slug;
    }
}
