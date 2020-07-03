@component('mail::message')
# You won a contest!

Your design was voted as the winner of the contest.

@component('mail::button', ['url' => route('contests.show', $contest)])
Visit the contest
@endcomponent

What happens next?

- Before you receive payment we ask you to upload your source files using the button below.
- You will receive an email once everything is approved.
- You will receive your payout within 2 weeks.

## Source files

In order for the completion of your payout we require you to upload your design source files.

@component('mail::button', ['url' => route('contests.files.create', $contest)])
Upload source files
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
