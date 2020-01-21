@component('mail::message')
# You won a contest!

Your design was voted as the winner of the contest.

What happens next?

- Before you receive payment we ask you to upload your source files using the button below.
- To receive payment you need to verify your identity using the Stripe verification process.
- Once everything is approved you will receive your payout within 2 weeks.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
