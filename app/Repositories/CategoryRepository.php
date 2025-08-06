<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function createCategory($data, $photo)
    {
        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/categories');
        }

        return Category::create($data);
    }

    public function updateCategory($id, $data, $photo)
    {
        $category = Category::findOrFail($id);

        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/categories');
        }

        $category->update($data);

        return $category;
    }
}
