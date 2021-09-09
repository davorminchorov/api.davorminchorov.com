@component('mail::message')
### From: {{ $contactDetails->get('name') }} ({{ $contactDetails->get('email') }})

{{ $contactDetails->get('message') }}
@endcomponent
