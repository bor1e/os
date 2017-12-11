@extends('layouts.app')

@section('content')
  @foreach ($courses as $course)
    @if ($loop->index % 3 == 0)
      <div class="card-deck mt-4">
    @endif
        <div class="card">
            <!-- CARD HEADER -->
            <div class="card-header">
              <nav class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-info-{{ $course->id }}" role="tab" aria-controls="nav-info-{{ $course->id }}" aria-selected="true">Info</a>
                <a class="nav-item nav-link" id="nav-description-tab" data-toggle="tab" href="#nav-description-{{ $course->id }}" role="tab" aria-controls="nav-description" aria-selected="false">About</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-teacher-{{ $course->id }}" role="tab" aria-controls="nav-teacher" aria-selected="false">Teacher</a>
              </nav>
            </div>

            <div class="card-body">
              <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-info-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-info-tab">
                  <h4>{{$course->title}}</h4>
                  <p class="card-text">{{ $course->description }}</p>
                  <!--a href="/courses/{ { $course->slug }}" class="btn btn-primary">Enroll</a-->
                  <a href="/courses/{{ $course->id }}" class="btn btn-primary">Enroll</a>
                </div>

                <div class="tab-pane fade" id="nav-description-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-description-tab">
                  <h4>Description</h4>
                  <p class="card-text">{{ $course->body }}</p>
                  <a href="/courses/{{ $course->slug }}" class="btn btn-primary">Enroll</a>
                </div>


                <div class="tab-pane fade" id="nav-teacher-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-teacher-tab">
                  <h4> TODO </h4>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  <a href="/courses/{{ $course->slug }}" class="btn btn-primary">Explore</a>
                </div>

              </div>
          </div>

          <!div class="card-footer">
            <!--small class="text-muted">{ {$course->datetimetz}}</small-->
            <img class="card-img-bottom" src="/images/350x150.png" alt="Card image cap">
          <!/div>

        </div>

    @if ($loop->index % 3 == 2 or $loop->last )
      </div>
    @endif
  @endforeach
@endsection
