<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatePostController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->hasFile('img')) {
            $validatedImg = $request->validate([
                'img' => 'mimes:png,jpg,jpeg,gif|max:10048'
            ]);

            
        }
    }
}
