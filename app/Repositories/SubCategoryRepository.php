<?php

namespace App\Repositories;

use App\Models\SubCategory;

class SubCategoryRepository
{
    public function createSubCategory($data)
    {
        return SubCategory::create($data);
    }

    public function updateSubCategory($id, $data)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update($data);
        return $subCategory;
    }
}
