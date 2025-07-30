<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $CategoryRepository;

    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }
    public function saveCategory(array $data, $photo = null)
    {
        return $this->CategoryRepository->createCategory($data, $photo);
    }
}
