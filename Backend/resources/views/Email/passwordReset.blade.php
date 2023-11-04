@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => env('FRONTEND_URL'). '/reset-password?token='.$token.'&email='.$email])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent