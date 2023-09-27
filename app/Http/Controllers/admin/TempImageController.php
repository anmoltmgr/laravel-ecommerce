<?php

namespace App\Http\Controllers\admin;

use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TempImageController extends Controller
{
    public function create(Request $request)
    {
        try {
            $image = $request->image;
            if (!empty($image)) {
                $ext = $image->getClientOriginalExtension();
                $newName = time() . '.' . $ext;

                $tempImage = new TempImage();
                $tempImage->name = $newName;
                $tempImage->save();

                $image->move(public_path() . '/temp', $newName);

                return response()->json([
                    'status' => true,
                    'image_id' => $tempImage->id,
                    'message' => "Image uplaoded Successfully !!!"
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
