<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function addFriend(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required']
        ]);
        $friend = Friend::where('receiver_id', $validated['user_id'])
            ->where('sender_id', Auth::id())
            ->first();
        if ($friend) {
            $friend->delete();
            return response()->json(['status' => '<i class="fa fa-user-plus" ></i> Add Friend']);
        }
          Notification::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $validated['user_id'],
                'message' => Auth::user()->name . "  send you a friend request",
                'type' => 'addFriend'
            ]);
        Friend::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $validated['user_id'],
            'status' => 'pending'
        ]);
        return response()->json(['status' => 'request sent']);
    }
  public function addFriendDecide(Request $request)
{
    $validated = $request->validate([
        'status' => ['required', 'in:accept,reject'],
        'notification_id' => ['required', 'exists:notifications,id'],
    ]);

    $notification = Notification::where('id', $validated['notification_id'])
        ->where('receiver_id', Auth::id())
        ->firstOrFail();

    $friendStatus = $validated['status'] === 'accept'
        ? 'accepted'
        : 'rejected';

    $friend = Friend::where('sender_id', $notification->sender_id)
        ->where('receiver_id', Auth::id())
        ->firstOrFail();

    $friend->update([
        'status' => $friendStatus,
    ]);



    return back()->with('success', "Friend request {$friendStatus}.");
}


}
