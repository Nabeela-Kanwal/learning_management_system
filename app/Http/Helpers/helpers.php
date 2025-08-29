<?php

use App\Models\Category;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


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

    return $path . '/' . $fileName;
}


if (!function_exists('setSidebar')) {
    function setSidebar(array $routes, string $activeClass = 'open active'): string
    {
        $currentRoute = request()->route()?->getName();

        foreach ($routes as $routePattern) {
            if (Str::is($routePattern, $currentRoute)) {
                return $activeClass;
            }
        }

        return '';
    }
}


if (!function_exists('getCategories')) {
    function getCategories()
    {
        return Category::with('subCategory')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
