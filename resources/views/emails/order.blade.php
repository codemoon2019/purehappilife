@component('mail::message')
# Thankyou for placing your Order with Cartsy Gallery PH

Your order # {{ $email_data['order_number'] }} status. Using our {{ $email_data['order_type'] }} payment method.

<h1 style="text-align:center;">{{ $email_data['order_status'] }}</h1>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
