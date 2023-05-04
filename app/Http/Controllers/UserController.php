<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource; 
use App\Http\Resources\UserSearchResource; 

class UserController extends Controller
{
    public function index() {
        return UserResource::make(auth()->user());
    }

    public function search(Request $request) {

        $first_name = $request->query('first_name');
        $last_name = $request->query('last_name');

        return UserSearchResource::collection(User::where('first_name', 'like', '%' . $first_name . '%')->whereOr('last_name', 'like', '%' . $last_name . '%')->paginate());
    }
}
