<?php

namespace App\Http\Services;


use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function saveUserAvatar($request)
    {
        //Delete old avatar
        $this->deleteUserAvatar();

        //Create unique name
        $file_name = Auth::user()->id.'-'.str_replace(' ', '_', $request->file->getClientOriginalName());

        //Save file and store link to db
        $image = Image::create(['img_url' =>
            $request->file('file')->storeAs('', $file_name)
        ]);
        Auth::user()->image()->associate($image)->save();
    }

    public function deleteUserAvatar()
    {
        if (Auth::user()->image) {
            Auth::user()->image()->delete();
            Storage::delete(Auth::user()->image->img_url);
        }
    }
}