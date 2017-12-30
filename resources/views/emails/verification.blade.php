@component('mail::message')
# Email bestätigen

@if ($user->gender == 'male')
  Lieber {{ $user->first_name }},
@else
  Liebe {{ $user->first_name }},
@endif
Bitte bestätigen Sie Ihre Email Adresse:

@component('mail::button', ['url' => $user->email_verification_url])
Jetzt bestätigen
@endcomponent

Vielen Dank<br>
{{ config('app.name') }}
@endcomponent
