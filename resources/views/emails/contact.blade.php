@component('mail::message')
# Kontaktanfrage von: {{ $contact['name'] }}

@component('mail::panel')
## Nachricht:
{{ $contact['message'] }}
@endcomponent

@if (array_key_exists('ismember', $contact))
# Is Member
@endif

@if (array_key_exists('phone', $contact))
## Telefon {{ $contact['phone'] }}
@endif

## <a href="mailto:{{ $contact['email'] }}">{{ $contact['name'] }}</a> antworten!
Euer<br>
{{ config('app.name') }}-Team
@endcomponent
