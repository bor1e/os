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
  @include('courses.feedbacks')
  @if (auth()->check())
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
  @else
    <p class="mt-3">Please <a href="{{route('login') }}">sign in</a> to give a feedback, or ask a question.</p>
  @endif
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
