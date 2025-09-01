<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository
{
    public function createBanner($data, $photo)
    {
        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/banner');
        }

        return Banner::create($data);
    }
}
