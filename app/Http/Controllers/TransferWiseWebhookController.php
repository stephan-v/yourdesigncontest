<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransferWiseWebhookController extends Controller
{
    /**
     * Handle a Stripe webhook call.
     *
     * @param Request $request The incoming HTTP client request.
     * @return Response The server response.
     */
    public function handleWebhook(Request $request)
    {
        $transferId = $request->input('data.resource.id');

        return $transferId;
    }
}
