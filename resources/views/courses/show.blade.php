@extends('layouts.app')

@section('content')
  <div class="mt-3">
        <h1>{{$course->title}}</h1>
        <h4 class="muted-text">{{$course->description}}</h4>
  </div>
  <hr>
  <p class="lead">
    {{ $course->body }}
  </p>
  <hr>
  <h1>Participants <span class="muted-text">({{ $course->users()->count() }})</span></h1>
  <p>
  <ul class="list-group">
    @foreach ($course->users() as $user)
      <li class="list-group-item">{{  $user->last_name . ', ' . $user->first_name }}</li>
    @endforeach
  </ul>
</p>
@endsection
