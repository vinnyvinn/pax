@component('mail::message')
#### Dear {{ ucwords(strtolower($user->name)) }},

We have received your shipment and below is your clearance proforma invoice.


@include('emails.invoice.invoice-partial')


Thanks,<br>
{{ config('app.name') }}
@endcomponent
