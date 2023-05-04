<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $user = auth()->user();

        // Check if the user has already liked the post
        $existingLike = $user->likes()->where('post_id', $post->id)->first();

        if ($existingLike) {
            // If the user has already liked the post, remove the like
            $existingLike->delete();
            return response()->json(['message' => 'Like removed']);
        }

        // If the user has not liked the post yet, add a like
        $like = new Like(['user_id' => $user->id]);
        $post->likes()->save($like);

        return response()->json(['message' => 'Post liked']);
    }
}
