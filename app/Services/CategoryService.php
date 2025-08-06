<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function saveCategory(array $data, $photo = null)
    {
        return $this->categoryRepository->createCategory($data, $photo);
    }

    public function updateCategory($id, array $data, $photo = null)
    {
        return $this->categoryRepository->updateCategory($id, $data, $photo);
    }
}
