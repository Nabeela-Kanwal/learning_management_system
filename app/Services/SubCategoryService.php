<?php

namespace App\Services;

use App\Repositories\SubCategoryRepository;

class SubCategoryService
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function saveSubCategory(array $data)
    {
        return $this->subCategoryRepository->createSubCategory($data);
    }

    public function updateSubCategory($id, array $data)
    {
        return $this->subCategoryRepository->updateSubCategory($id, $data);
    }
}
