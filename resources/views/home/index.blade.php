@extends('layouts.app')

@section('content')
    <h1>Current Lectures</h1>
      @include('courses.helpers.enrolled_courses')
      @include('courses.helpers.notification')
    <div class="row justify-content-center">
      @foreach ($courses as $course)
          @if ($loop->index % 3 == 0)
              <div class="card-deck my-3 text-left">
          @endif
            <div class="card">
              <div class="card-header">
                <nav class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info-{{ $course->id }}" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                  <a class="nav-item nav-link" id="nav-description-tab" data-toggle="tab" href="#nav-description-{{ $course->id }}" role="tab" aria-controls="nav-description" aria-selected="false">About</a>
                  @if ($course->hasTeacher())
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-teacher-{{ $course->id }}" role="tab" aria-controls="nav-teacher" aria-selected="false">Teacher</a>
                  @endif
                </nav>
              </div>

              <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    @include('courses.helpers.course_info')
                    @include('courses.helpers.course_description')
                    @include('courses.helpers.course_teacher')
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

        @break($loop->index >= 6)
      @endforeach
    </div>
    <a class="btn btn-success float-right" href="/courses" role="button">Continue to Current Program</a>
    <br><br><hr>
    <h1>Archive</h1>
    <div class="row justify-content-center">
        @foreach ($archives as $course)
            @if ($loop->index % 3 == 0)
                <div class="card-deck my-3 text-left">
            @endif
              <div class="card">
                <div class="card-header">
                  <nav class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info-{{ $course->id }}" role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                    <a class="nav-item nav-link" id="nav-description-tab" data-toggle="tab" href="#nav-description-{{ $course->id }}" role="tab" aria-controls="nav-description" aria-selected="false">About</a>
                    @if ($course->hasTeacher())
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-teacher-{{ $course->id }}" role="tab" aria-controls="nav-teacher" aria-selected="false">Teacher</a>
                    @endif
                  </nav>
                </div>

                <div class="card-body">
                  <div class="tab-content" id="nav-tabContent">
                      @include('courses.helpers.course_info')
                      @include('courses.helpers.course_description')
                      @include('courses.helpers.course_teacher')
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

          @break($loop->index >= 8)
        @endforeach
    </div>
    <a class="btn btn-success float-right" href="/archives" role="button">Continue to the Archives</a>

    @include('courses.helpers.create_course')

@endsection
