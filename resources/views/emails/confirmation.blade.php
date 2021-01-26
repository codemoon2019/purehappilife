@component('mail::message')
# Welcome to Pure Happilife PH

Please use this password to login your account in Pure Happilife PH.

<h1 style="text-align:center;">{{ $email_data['password'] }}</h1>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
