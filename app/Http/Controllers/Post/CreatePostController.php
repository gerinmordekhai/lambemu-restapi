<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatePostController extends Controller
{
    public function __invoke(CreatePostRequest $request)
    {
        $desc = $request->desc;
        $img = $request->img;

        if ($request->hasFile('img')) {
            $file = filePath($img);
            $img = $file;
        }

        try {
            $user = Auth::user();
            $post = new Post();

            $post->user_id = $user->id;
            $post->img = $img;
            $post->desc = $desc;

            return new PostResource(true, 'membuat post', $post);
        } catch (\Exception $e) {
            return new ErrorResource(false, 'error', $e->getMessage());
        }
    }
}
