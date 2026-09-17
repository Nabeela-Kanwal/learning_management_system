<?php

namespace App\Repositories;

use App\Models\Info;

class InfoRepository
{
    public function getInfos()
    {
        return Info::orderBy('sort_order')->orderBy('id')->paginate(15);
    }

    public function getActiveInfos()
    {
        return Info::where('status', true)->orderBy('sort_order')->orderBy('id')->get();
    }

    public function getInfo($id): Info
    {
        return Info::findOrFail($id);
    }

    public function createInfo(array $data): Info
    {
        return Info::create($data);
    }

    public function updateInfo($id, array $data): Info
    {
        $info = $this->getInfo($id);
        $info->update($data);

        return $info;
    }

    public function deleteInfo($id): bool
    {
        return $this->getInfo($id)->delete();
    }
}
