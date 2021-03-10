@extends('layouts.master')

@section('title', 'FAQ')

@section('content')
    <div class="container notifications-index">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Frequently asked questions</h1>
                    <ul class="list-group list-unstyled">
                        <li class="card">
                            <div class="card-header" id="platform-fee">Why is there a platform fee?</div>

                            <div class="card-body">
                                <p>The platform fee exists to offset business costs and to make sure the winning designer it not confronted with hidden fees during a payout.</p>

                                <p>We like to be transparent and provide you with the cost of doing business on our platform instead of hiding costs inside of priced packages like some competitors do. Some of these costs are:</p>

                                <ul class="pl-3">
                                    <li>Platform maintenance</li>
                                    <li>Hosting</li>
                                    <li>Transactional mails</li>
                                    <li>Banking fees which occur during payments/payouts.</li>
                                    <li>Content writing</li>
                                    <li>Administrative costs.</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
