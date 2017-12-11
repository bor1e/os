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
@endsection
