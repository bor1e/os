@extends('layouts.app')
@section('content')
  <div class="row mt-3">
    <div class="col-8">
      <h1>{{$course->title}}</h1>
      <p class="h4"><span class="badge badge-pill badge-primary">{{ array('Sonntag','Montag', 'Dienstag', 'Mittwoch','Donnerstag', 'Freitag','Samstag')[date('w', strtotime($course->date))] .' ('.date('d.m', strtotime($course->date)).'), um ' . substr($course->time, 0, 5) }}</span></p>
      <h4 class="muted-text">{{$course->description}}</h4>
    </div>

    @can('update', $course)
    <div class="col-4 text-right">
        <a href="{{ $course->path() }}/edit" class="btn btn-success">Edit</a>
    </div>
    @endcan
  </div>
  <hr>
  <p class="lead">
    {{ $course->body }}
  </p>
  @if ($course->dedication)
    <p class="text-center">
      <strong>This is course is dedicated to:</strong><br>
      {{ $course->dedication }}
    </p>
  @endif
  <p class="text-right">
    @if ($course->hasTeacher())
    <strong>Teacher:</strong> {{$course->teacher->profile->title .' '. $course->teacher->first_name .' '.$course->teacher->last_name}}
    @else
      <i>A teacher will be assigned soon.</i>
    @endif
  </p>
  @can('participateInCourse')
    <p class="lead">
      <a href="{{ $course->gtm_id }}" class="btn btn-primary">GoToMeeting</a>
    </p>
  @endcan
  <hr>

  @include('courses.helpers.feedbacks')

  <hr>
  @include('courses.helpers.participants')

@endsection
