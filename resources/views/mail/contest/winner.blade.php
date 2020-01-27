@component('mail::message')
# You won a contest!

Your design was voted as the winner of the contest.

What happens next?

- Before you receive payment we ask you to upload your source files using the button below.
- To receive payment you need to verify your identity using the Stripe verification process.
- Once everything is approved you will receive your payout within 2 weeks.

@component('mail::button', ['url' => route('contests.show', ['contest' => $contest])])
Visit the contest
@endcomponent

## Source files

In order for the completion of your payout we required you to upload your design source files.

@component('mail::button', ['url' => route('contests.files.create', ['contest' => $contest])])
Upload source files
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
