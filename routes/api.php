<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::post("/upload", [ImageController::class, "upload"]);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::resource("posts", PostController::class);
    Route::resource("comments", CommentController::class);
    Route::resource("friend-requests", FriendRequestController::class);
    Route::resource("friends", FriendController::class);
    Route::get("/user", [UserController::class, "index"]);
    Route::get("/profile-posts", [PostController::class, "getProfilePosts"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post('/posts/{post}/like', [LikeController::class, 'store']);
    Route::get("/search", [UserController::class, "search"]);
});
