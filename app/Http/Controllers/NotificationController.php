<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\AssignmentNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;


class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $notifications = $request->user()->notifications;
        
        return view('pages.notifications_index', compact('notifications'));
    }


    public function unreadNotifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        
        return view('pages.notifications_index', compact('unreadNotifications'));
    
    }

    public function getNotificationCount()
   {
      $notificationCount = auth()->user()->unreadNotifications->count();

      return response()->json(['count' => $notificationCount]);
    }
 

    public function markNotificationAsRead($notification)
{
    $notification = auth()->user()->notifications()->findOrFail($notification);
    $notification->markAsRead();

    $unreadNotifications = auth()->user()->unreadNotifications;
    $notificationCount = $unreadNotifications->count();

    $view = view('notifications.index', compact('unreadNotifications'))->render();

    return response()->json([
        'html' => $view,
        'count' => $notificationCount,
    ]);
}

}
