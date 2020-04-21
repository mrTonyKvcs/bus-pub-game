<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//User
Route::post('/registration', 'Api\UsersController@registration');
Route::post('/login', 'Api\UsersController@login');
Route::get('/notifications/{id}', 'Api\UsersController@notifications');

//Friendable
Route::get('add-friend/{senderId}/{recipientId}', 'Api\FriendableController@sendFriendRequest');
Route::get('confirmation/{recipientId}/{senderId}', 'Api\FriendableController@confirmation');
Route::get('deny-friend-request/{recipientId}/{senderId}', 'Api\FriendableController@denyFriendRequest');
Route::get('delete-friend/{userId}/{friendId}', 'Api\FriendableController@deleteFriend');
