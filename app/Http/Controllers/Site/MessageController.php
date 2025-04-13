<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;

class MessageController extends Controller {


public function checkNewMessages()
{
    $notifications = auth('web')->user()->unreadNotifications;  // Get unread notifications for the authenticated user

    return response()->json([
        'notifications' => $notifications,
    ]);
}
public function markNotificationsAsRead()
{
    auth('web')->user()->unreadNotifications->markAsRead();  // Mark all notifications as read
    return response()->json(['message' => 'Notifications marked as read']);
}

}
?>