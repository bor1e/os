@component('mail::message')
<p style="text-align:right">
  בס"ד
</p>
<!-- TODO: anpassen an änderung des status-->
# Sie wurden freigeschaltet, herzlich Willkommen!
@if ($user->gender == 'male')
  Lieber {{ $user->first_name }},
@else
  Liebe {{ $user->first_name }},
@endif
<br>
Bitte bestätigen Sie Ihre Email Adresse:

@component('mail::button', ['url' => 'online-shiurim.org/courses'])
Jetzt für Kurse anmelden!
@endcomponent

Viel Spaß beim Lernen wünscht dir <br>
Dein {{ config('app.name') }}-Team
@endcomponent
