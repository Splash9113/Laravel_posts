<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(ImageRequest $request)
    {
        $image = Image::create(['img_url' =>
            $request->file('file')->move('images', $request->file->getClientOriginalName())->getPathname()
        ]);
        Auth::user()->image()->associate($image)->save();
        return back();
    }
}
