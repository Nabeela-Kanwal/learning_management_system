<?php

namespace App\Services;

use App\Repositories\BannerRepository;

class BannerService
{
    protected $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function saveBanner(array $data, $photo = null)
    {
        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/banner');
        }

        return $this->bannerRepository->createBanner($data);
    }

    public function updateBanner($id, array $data, $photo = null)
    {
        return $this->bannerRepository->updateBanner($id, $data, $photo);
    }
}
