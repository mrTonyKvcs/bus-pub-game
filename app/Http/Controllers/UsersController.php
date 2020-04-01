<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Hootlex\Friendships\Models\Friendship;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notifications()
    {
        $authUser = Auth::user();

        $friends = $authUser->getFriends();

        $senders = Friendship::
            where('sender_id', $authUser->id)
            ->where('status', 0)
            ->get();

        $recipients = Friendship::
            where('recipient_id', $authUser->id)
            ->where('status', 0)
            ->get();

        //dd($recipients);
        //dd($authUser->id);
        //$recipients = $authUser->friends()->whereRecipient($authUser)->get();
        //dd($recipients);

        return view('users.notifications', compact('friends', 'recipients', 'senders'));
    }
}
