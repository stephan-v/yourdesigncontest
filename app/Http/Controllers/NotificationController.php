<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View The HTML server response.
     */
    public function index()
    {
        return view('notification.index');
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
