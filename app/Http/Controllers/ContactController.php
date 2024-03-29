<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\View;

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
     *
     * @param ContactRequest $request The server request.
     * @return RedirectResponse Returns a redirect back to the previous location.
     */
    public function email(ContactRequest $request)
    {
        if (!$request->has('detection')) {
            abort(422, 'Spam detected');
        }

        if (!empty(request('detection'))) {
            abort(422, 'Spam detected');
        }

        $now = microtime(true);
        $elapsed = $now - request('time');

        if ($elapsed  <= 3) {
            abort(422, 'Spam detected');
        }

        Mail::to($request->email)->send(new ContactMail($request->all()));

        // @TODO fix.
        Mail::to('info@yourdesigncontest.com')->send(new ContactMail($request->all()));

        return back()->with('message', 'Thanks for contacting us we will respond as soon as possible.');
    }
}
