<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    public function storeImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,png,jpeg,bmp|max:2048'
        ]);
        if($request->hasFile('image')) {
            $path = Storage::disk('public')->put('images/photos', $request->image);
            return response()->json(['imageURL'=>URL::to('/') . '/storage/'.$path]);
        }else{
           throw new ValidationDataError('ERR_IMAGE_UPLOAD', 422, 'Image can not be uploaded');
        }
    }
}
