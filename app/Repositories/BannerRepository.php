<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository
{
    public function createBanner(array $data)
    {
        return Banner::create($data);
    }

    public function updateBanner($id, array $data, $photo = null)
    {
        $banner = Banner::findOrFail($id);

        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/banner');
        }

        $banner->update($data);

        return $banner;
    }
}
