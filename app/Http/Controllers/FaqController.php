<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View The HTML server response.
     */
    public function index()
    {
        return view('faq.index');
    }
}
