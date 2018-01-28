@component('mail::message')
<p style="text-align:right">
  בס"ד
</p>
<!-- TODO: anpassen an änderung des status-->
Dein Kurs heute:
# {{$course->title}}
## Heute um {{$course->time}}
{{$course->body}}
<br>
{{--
@component('mail::table')

|#| Title | Teacher | Date | Time | Link |
|-|-------|---------|------|------|------|
@foreach ($user->participates as $key => $course)
|{{$key+1}} | {{$course->title}} | {{$course->teacher}} | {{$course->date}} | {{$course->time}} |  @component('mail::button', ['url' => 'online-shiurim.org/courses'])
        Zum Kurs
        @endcomponent|

@endforeach
@endcomponent

    @component('mail::button', ['url' => 'online-shiurim.org/courses'])
    Weitere Kurse anschauen.
    @endcomponent
--}}
Viel Spaß beim Lernen wünscht dir <br>
Dein {{ config('app.name') }}-Team
@endcomponent
