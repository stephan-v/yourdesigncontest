<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request The incoming HTTP client request.
     * @return View The HTML server response.
     */
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(5);

        return view('notification.index', compact('notifications'));
    }

    /**
     * Mark the unread notifications as read.
     *
     * @param Request $request The incoming HTTP client request.
     */
    public function markAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
    }
}
