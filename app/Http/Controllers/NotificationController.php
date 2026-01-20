<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
   public function notificationPage()
{
    Notification::where('receiver_id', Auth::user()->id)
        ->where('isread', false)
        ->update(['isread' => true]);

    $notifications = Notification::where('receiver_id', Auth::user()->id)
        ->latest()
        ->get();

    return view('notifications', ['notifications' => $notifications]);
}

}
