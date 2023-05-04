<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Friend;
use App\Http\Resources\FeedResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friends = Friend::select('friends_with')->where('user_id', auth()->user()->id)->get();

        $friendsFlat = [];

        foreach ($friends as $friend) {
            $friendsFlat[] = $friend->friends_with;
        }

        return FeedResource::collection(Post::whereIn('user_id', $friendsFlat)->orderBy('created_at', 'desc')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $fields = $request->validate([
        'body' => 'required|string',
        'media' => 'nullable|string'
    ]);

    $post = Post::create([
        'user_id' => auth()->user()->id,
        'body' => $fields['body'],
        'media' => $fields['media']
    ]);

    return response()->json($post, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'user_id' => 'sometimes|required',
            'body' => 'sometimes|required',
            'media' => 'sometimes|required'
        ]);

        $post->update($request->all());

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function like(int $postId)
    {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        // Check if the user has already liked the post
        $like = Like::where('user_id', $user->id)->where('post_id', $postId)->first();

        if ($like) {
            // If the user has already liked the post, unlike it
            $like->delete();
            return response()->json(['message' => 'Post unliked']);
        } else {
            // If the user has not liked the post yet, like it
            Like::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
            return response()->json(['message' => 'Post liked']);
        }
    }

    public function getProfilePosts()
    {
        return FeedResource::collection(Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate());
    }
}
