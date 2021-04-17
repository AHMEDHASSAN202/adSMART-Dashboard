<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(Request $request, $module)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['status' => 'ERROR'], 400);
        }

        $path = $request->file('file')->store('images/tiny-editor/' . $module, 'public');

        return response()->json(['location' => asset("storage/$path")]);
    }
}
