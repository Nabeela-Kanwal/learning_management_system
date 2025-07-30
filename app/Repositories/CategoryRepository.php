<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function createCategory($data, $photo)
    {
        if ($photo && $photo->isValid()) {
            $data['photo'] = upload_image($photo, 'images/categories');
        }

        return Category::create($data);
    }
}
