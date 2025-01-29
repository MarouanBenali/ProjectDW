<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller{
    public function getNotifications(Request $request)
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->get();

        return response()->json($notifications);
    }
}
