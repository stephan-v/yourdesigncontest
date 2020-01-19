<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
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
