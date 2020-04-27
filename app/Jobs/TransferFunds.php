<?php

namespace App\Jobs;

use App\Domain\Payment\PaymentGateway;
use App\Domain\Payout\PlatformPayout;
use App\Exceptions\PayoutException;
use App\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\Exception\ApiErrorException;

class TransferFunds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The pending payout to process.
     *
     * @var Payout $payout
     */
    private $payout;

    /**
     * Create a new job instance.
     *
     * @param Payout $payout The pending payout to process.
     */
    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
    }

    /**
     * Execute the job.
     *
     * @param PaymentGateway $paymentGateway The payment gateway used to transfer funds.
     * @param PlatformPayout $platformPayout The platform payout service.
     * @throws PayoutException Thrown if payout fails.
     * @throws ApiErrorException Thrown if there is a payment gateway error.
     */
    public function handle(PaymentGateway $paymentGateway, PlatformPayout $platformPayout)
    {
        $payout = $this->payout;

        if ($payout->succeeded) {
            throw PayoutException::duplicatePayout();
        }

        // Transfer Stripe platform funds to the connect account of the winning designer.
        $paymentGateway->transfer(
            $payout->user,
            $payout->amount,
            $payout->currency
        );

        // Update the local payout record.
        $payout->update(['status' => Payout::SUCCEEDED]);

        // Create a platform payout from the payment gateway to the bank account.
        $platformPayout->create($payout->contest);
    }
}
