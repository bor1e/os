@component('mail::message')
<p style="text-align:right">
  בס"ד
</p>
# Email bestätigen
@if ($user->gender == 'male')
  Lieber {{ $user->first_name }},
@else
  Liebe {{ $user->first_name }},
@endif
<br>
Bitte bestätigen Sie Ihre Email Adresse:

@component('mail::button', ['url' => $user->getEmailVerificationUrl()])
Jetzt bestätigen
@endcomponent

Vielen Dank,<br>
{{ config('app.name') }}
@endcomponent
