@extends('layouts.app')

@section('content')
  @foreach ($courses as $course)
    @if ($loop->index % 3 == 0)
      <div class="card-deck my-3">
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
                  <h4>{{ $course->teacher()->title .' '. $course->teacher()->last_name  . ', ' . $course->teacher()->first_name }}</h4>
                  <p class="card-text">
                    <ul>
                      <li>Email: {{ $course->teacher()['email'] }}</li>
                      <li>City: {{ $course->teacher()['city'] }}</li>
                    </ul>
                  </p>
                  <a href="fb.com/{{ $course->teacher()['social'] }}" class="btn btn-primary">Follow on Facebook</a>
                </div>

              </div>
          </div>

          <div class="card-footer">
            <div class="row justify-content-between">
             <div class="col-8">
               <small class="text-muted">{{$course->created_at->diffForHumans()}}</small></li>
             </div>
             <div class="col-3">
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
@endsection
