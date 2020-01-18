<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user The user to display.
     * @return View The HTML server response.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }
}
