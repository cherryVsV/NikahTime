<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    public function storeFile(Request $request)
    {
        $this->validate($request, [
            'fileType'=>['required', 'string']
        ]);
        if($request->fileType == 'image') {
            $this->validate($request, [
                'file' => 'required|mimes:jpg,png,jpeg,bmp|max:2048'
            ]);
            if ($request->hasFile('file')) {
                $path = Storage::disk('public')->put('images/photos', $request->file);
                return response()->json(['fileURL' => URL::to('/') . '/storage/' . $path, 'fileType'=>'image']);
            } else {
                throw new ValidationDataError('ERR_IMAGE_UPLOAD', 422, 'Image can not be uploaded');
            }
        }
        if($request->fileType == 'file') {
            if ($request->hasFile('file')) {
                $path = Storage::disk('public')->put('files', $request->file);
                return response()->json(['fileURL' => URL::to('/') . '/storage/' . $path, 'fileType'=>'file']);
            } else {
                throw new ValidationDataError('ERR_FILE_UPLOAD', 422, 'File can not be uploaded');
            }
        }
     /* if($request->fileType == 'video') {
            if ($request->hasFile('file')) {
                try {
                    $source = $request->file;
                    $orig_file_size = filesize($source);
                    $destination = 'storage/video/video.mp4';

                    $chunk_size = 256; // chunk in bytes
                    $upload_start = 0;

                    $handle = fopen($source, "rb");

                    $fp = fopen($destination, 'w');

                    while($upload_start < $orig_file_size) {

                        $contents = fread($handle, $chunk_size);
                        fwrite($fp, $contents);

                        $upload_start += strlen($contents);
                        fseek($handle, $upload_start);
                    }

                    fclose($handle);
                    fclose($fp);
                    return response()->json('yes');
                   // $path = Storage::disk('public')->put('video', $request->file);
                   // return response()->json(['fileURL' => URL::to('/') . '/storage/' . $path, 'fileType'=>'video']);
                } catch (Exception $e) {
                    throw new ValidationDataError('ERR_VIDEO_UPLOAD', 422, $e);
                }
            }
        }*/
    }
}
