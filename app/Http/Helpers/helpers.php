<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

function upload_image($image, $path)
{
    if (!$image || !$image->isValid()) {
        return null;
    }

    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0755, true);
    }

    $fileName = time() . rand(1, 999) . '_' . Str::random(45) . "." . $image->getClientOriginalExtension();
    $image->move(public_path($path), $fileName);

    // ✅ Return relative path instead of just filename
    return $path . '/' . $fileName;
}
