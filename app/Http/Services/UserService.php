<?php

namespace App\Http\Services;


use Illuminate\Support\Facades\Auth;

class UserService
{
    public $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function deleteUserProfile()
    {
        //don't need if use a soft delete
//        $this->imageService->deleteUserAvatar();
        Auth::user()->delete();
    }
}