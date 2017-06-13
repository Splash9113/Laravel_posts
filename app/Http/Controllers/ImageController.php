<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Services\ImageService;

class ImageController extends Controller
{
    public $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function uploadAvatar(ImageRequest $request)
    {
        $this->imageService->saveUserAvatar($request);

        return back();
    }

    public function deleteAvatar()
    {
        $this->imageService->deleteUserAvatar();
        return back();
    }
}
