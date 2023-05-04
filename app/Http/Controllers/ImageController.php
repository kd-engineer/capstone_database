<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        $image_name = time() . '.' . $request->image->extension();
        $path = $request->image->storeAs('public/images', $image_name);
        $url = Storage::url($path);

        $response = [
            'image_name' => $image_name,
            'image_url' => $url
        ];

        return response($response, Response::HTTP_CREATED);
    }

    public function getImage($imagename) {
        $imagePath = storage_path('app/public/images/' . $imagename);

        if (file_exists($imagePath)) {
            $image = file_get_contents($imagePath);
            return response($image, 200)->header('Content-Type', 'image/jpg');
        }
        return response()->json(['message' => 'Image Not found'], 404);
    }
}
