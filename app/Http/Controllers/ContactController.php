<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show the application contact page.
     *
     * @return View The HTML server response.
     */
    public function form()
    {
        return view('pages.contact');
    }

    /**
     * Send out a contact email request.
     * @param ContactRequest $request The server request.
     * @return RedirectResponse Returns a redirect back to the previous location.
     */
    public function email(ContactRequest $request)
    {
        Mail::to($request->email)->send(new ContactMail($request->all()));

        return back()->with('message', 'Thanks for contacting us we will respond as soon as possible.');
    }
}
