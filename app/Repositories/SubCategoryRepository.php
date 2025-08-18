<?php

namespace App\Repositories;

use App\Models\SubCategory;

class SubCategoryRepository
{
    public function createSubCategory($data, $photo)
    {
        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/categories');
        }

        return SubCategory::create($data);
    }

    public function updateSubCategory($id, $data, $photo)
    {
        $subCategory = SubCategory::findOrFail($id);

        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/categories');
        }

        $subCategory->update($data);

        return $subCategory;
    }
}
