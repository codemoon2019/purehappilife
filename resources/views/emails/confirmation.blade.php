@component('mail::message')
# Welcome to Cartsy Gallery PH

Please use this password to login your account in Cartsy Gallery PH.

<h1 style="text-align:center;">{{ $email_data['password'] }}</h1>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
