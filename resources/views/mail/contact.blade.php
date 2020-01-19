@component('mail::message')
# Thank you for contacting us.

You wrote:

@component('mail::panel')
{{ $data['message'] }}
@endcomponent

We will get back to you as soon as possible.

Thanks,<br>

{{ config('app.name') }}
@endcomponent
