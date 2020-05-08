<?php

namespace App\Http\Controllers\Api;

use Hootlex\Friendships\Models\Friendship;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Auth;

class UsersController extends Controller
{
    public function allUser()
    {
        $users = User::all();

        return response($users, 201);
    }

    public function registration(Request $request)
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        User::create($request->all());

        return response(201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function notifications($id)
    {
        $user = User::find($id);

        $friends = $user->getFriends();

        $senders = Friendship::
            where('sender_id', $user->id)
            ->where('status', 0)
            ->get();

        $recipients = Friendship::
            where('recipient_id', $user->id)
            ->where('status', 0)
            ->get();

        $response = [
            'friends' => $friends,
            'senders' => $senders,
            'recipients' => $recipients
        ];

        return response($response, 201);
    }
}
