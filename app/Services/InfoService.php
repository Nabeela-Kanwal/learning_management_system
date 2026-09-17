<?php

namespace App\Services;

use App\Repositories\InfoRepository;

class InfoService
{
    public function __construct(protected InfoRepository $infoRepository) {}

    public function getInfos()
    {
        return $this->infoRepository->getInfos();
    }

    public function getActiveInfos()
    {
        return $this->infoRepository->getActiveInfos();
    }

    public function getInfo($id)
    {
        return $this->infoRepository->getInfo($id);
    }

    public function saveInfo(array $data)
    {
        return $this->infoRepository->createInfo($data);
    }

    public function updateInfo($id, array $data)
    {
        return $this->infoRepository->updateInfo($id, $data);
    }

    public function deleteInfo($id)
    {
        return $this->infoRepository->deleteInfo($id);
    }
}
