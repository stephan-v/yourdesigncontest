<?php

namespace App\Http\Controllers;

use App\Domain\Payout\Transferwise;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return View The HTML server response.
     */
    public function home(TransferWise $client)
    {
        dd($client->accounts()->get());

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
