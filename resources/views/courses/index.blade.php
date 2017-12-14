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
              @include('courses.card-body')
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
