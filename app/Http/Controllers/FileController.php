<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    public function storeFile(Request $request)
    {
        $this->validate($request, [
            'fileType' => ['required', 'string']
        ]);
        if ($request->fileType == 'image') {
            $this->validate($request, [
                'file' => 'required|mimes:jpg,png,jpeg,bmp|max:2048'
            ]);
            if ($request->hasFile('file')) {
                $path = Storage::disk('public')->put('images/photos', $request->file);
                return response()->json(['fileURL' => URL::to('/') . '/storage/' . $path, 'fileType' => 'image']);
            } else {
                throw new ValidationDataError('ERR_IMAGE_UPLOAD', 422, 'Image can not be uploaded');
            }
        }
        if ($request->fileType == 'file') {
            if ($request->hasFile('file')) {
                $path = Storage::disk('public')->put('files', $request->file);
                return response()->json(['fileURL' => URL::to('/') . '/storage/' . $path, 'fileType' => 'file']);
            } else {
                throw new ValidationDataError('ERR_FILE_UPLOAD', 422, 'File can not be uploaded');
            }
        }
        if ($request->fileType == 'video') {
            if ($request->hasFile('file')) {
                $path = Storage::disk('public')->put('video', $request->file);
                return response()->json(['fileURL' => URL::to('/') . '/storage/' . $path, 'fileType' => 'video']);
            } else {
                throw new ValidationDataError('ERR_VIDEO_UPLOAD', 422, 'Video can not be uploaded');
            }
        }
    }
}
