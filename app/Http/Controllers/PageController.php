<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return View The HTML server response.
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show the application process page.
     *
     * @return View The HTML server response.
     */
    public function process()
    {
        return view('pages.process');
    }
}
