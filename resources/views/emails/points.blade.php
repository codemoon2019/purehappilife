@component('mail::message')
# Congratulations!

You got an extra points by referring {{ $points_data['name'] }} to Pure PH you can use this points to buy products in Pure PH.

{{ $points_data['points'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
