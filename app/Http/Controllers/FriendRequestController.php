<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\Friend;

class FriendRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FriendRequest::where('user_to', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'user_to' => 'required|numeric'
        ]);

        $fr = FriendRequest::create([
            'user_id' => auth()->user()->id,
            'user_to' => $fields['user_to']
        ]);

        return response ($fr, 201);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, string $id)
    {
        $fields = $request->validate([
            'response' => 'required|boolean',
        ]);

        if ($fields['response']) {
            $fr = FriendRequest::find($id);
            Friend::insert([
                [
                    'user_id' => $fr->user_id,
                    'friends_with' => $fr->user_to
                ],
                [
                    'user_id' => $fr->user_to,
                    'friends_with' => $fr->user_id
                ],
                ]);
        }

        $this->destroy($id, $fields['response']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Bool $response)
    {
        FriendRequest::destroy($id);
        
        $acceptOrDeny = $response ? 'accepted' : 'rejected';

        $response = [
            'message' => 'Friend request' . $acceptOrDeny
        ];

        return response($response, 200);
    }
}
