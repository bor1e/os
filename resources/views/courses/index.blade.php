@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-11">
    @cannot('participateInCourse')
      <ul class="list-group mt-3">
        <li class="list-group-item list-group-item-warning">
        @if (!Auth::check())
          <p class="mt-3">Please <a href="{{route('login') }}">sign in</a> to enroll and to participate in classes.</p>
        @elseif (Auth::user()->hasRole('pending'))
          Please <a href="/profile"> update </a>your User Information, in order to be approved by the Admins.
        @endif
        </li>
      </ul>
    @endcannot
      @foreach ($courses as $course)
        @if ($loop->index % 3 == 0)
          <div class="card-deck my-3">
        @endif
            <div class="card">
              <!-- CARD HEADER -->
              <div class="card-header">
                <nav class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info-{{ $course->id }}" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                  <a class="nav-item nav-link" id="nav-description-tab" data-toggle="tab" href="#nav-description-{{ $course->id }}" role="tab" aria-controls="nav-description" aria-selected="false">About</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-teacher-{{ $course->id }}" role="tab" aria-controls="nav-teacher" aria-selected="false">Teacher</a>
                </nav>
              </div>

              <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                  @include('courses.card-body')
                </div>
              </div>

              <div class="card-footer">
                <div class="row justify-content-between">
                 <div class="col-8">
                   <small class="text-muted">{{$course->created_at->diffForHumans()}}</small></li>
                 </div>
                 <div class="col-3 text-right">
                   <i class="fa fa-users" aria-hidden="false">{{ ' '. $course->users()->count() }}</i>
                 </div>
               </div>
              </div>

              <img class="card-img-bottom" src="/images/350x150.png" alt="Card image cap">

            </div>

        @if ($loop->index % 3 == 2 or $loop->last )
          </div>
        @endif
      @endforeach
    </div>
    <div class="col-1 mt-4">
      <p>
      @can('create', App\Course::class)
        <a  href="/courses/create" class="btn btn-success">Create Course</a>
      <!--@ if (Auth::user()->hasRole('manager'))
        Manager!
      @ elseif (Auth::user()->hasRole('teacher'))
        Teacher!
      @ endif
-->
      @endcan
      </p>
    </div>
    </div>
  </div>

@endsection
