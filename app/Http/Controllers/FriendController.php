<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Friend::where('user_id', auth()->user()->id)->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Friend::where('user_id', $id)->get();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Friends::destroy($id);

        $response = [
            'message' => 'Unfriended'
        ];

        return response($response, 200);
    }
}
