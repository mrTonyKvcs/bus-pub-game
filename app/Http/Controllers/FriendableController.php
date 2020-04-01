<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class FriendableController extends Controller
{
    public function sendFriendRequest($recipientId)
    {
        $user = Auth::user();
        $recipient = User::find($recipientId);
        $user->befriend($recipient);
        return back();
    }

    public function denyFriendRequest($senderId)
    {
        $user = Auth::user();
        $sender = User::find($senderId);
        $user->denyFriendRequest($sender);
        return back();
    }

    public function deleteFriend($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);
        $user->unfriend($friend);
        return back();
    }

    public function confirmation($senderId)
    {
        $user = Auth::user();
        $sender = User::find($senderId);
        $user->acceptFriendRequest($sender);
        return back();
    }
}
