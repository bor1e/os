@extends('layouts.app')

@section('content')
  <div class="mt-3">
        <h1>{{$course->title}}</h1>
        <p class="h4"><span class="badge badge-pill badge-primary">{{ array('Sonntag','Montag', 'Dienstag', 'Mittwoch','Donnerstag', 'Freitag','Samstag')[date('w', strtotime($course->datetimetz))] .' ('.date('d.m', strtotime($course->datetimetz)).'), um ' . date('H:i', strtotime($course->datetimetz)) }}</span></p>
        <h4 class="muted-text">{{$course->description}}</h4>
  </div>
  <hr>
  <p class="lead">
    {{ $course->body }}
  </p>
  <p class="text-right">
    @if ($course->hasTeacher())
    <strong>Teacher:</strong> {{$course->teacher()->title .' '. $course->teacher()->first_name .' '.$course->teacher()->last_name}}
    @else
      <i>A teacher will be assigned soon.</i>
    @endif
  </p>
  <hr>
  @cannot('addFeedback')
    <ul class="list-group">
      <li class="list-group-item list-group-item-warning">
      @if (!Auth::check())
        <p class="mt-3">Please <a href="{{route('login') }}">sign in</a> to give a feedback, or ask a question.</p>
      @elseif (Auth::user()->hasRole('pending'))
        Please Update your User Information, in order to be approved by the Admins.
      @elseif (Auth::user())
        We are reviewing your registration, we will notify you, when the process is finished. You are welcome to <a href="/abouts-us#contact">contact</a> us.
      @endif
      </li>
    </ul>
  @endcannot
  @include('courses.feedbacks')
  @can('addFeedback')
    <div class="row mt-3">
      <div class="col-8">
        <div class="card">
          <form method="POST" action="{{ $course->path() . '/feedback' }}">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <textarea class="form-control" name="body" id="body" rows="3" placeholder="Leave a Feedback"></textarea>
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endcan
  <hr>
  <h1>Participants <span class="muted-text">({{ $course->users()->count() }})</span></h1>
  <p>
    @can('participateInCourse')
      <ul class="list-group">
        @foreach ($course->users() as $user)
          <li class="list-group-item">{{ $user->first_name . ', ' . substr($user->last_name, 0,1).'.' }}</li>
        @endforeach
      </ul>
    @endcan
  </p>
@endsection
