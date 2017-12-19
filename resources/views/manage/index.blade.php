@extends('layouts.app')

@section('content')
<div class="card my-4">
  <!-- CARD HEADER -->
  <div class="card-header">
    <nav class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
      <a class="nav-item nav-link active" id="nav-newUsers-tab" data-toggle="tab" href="#nav-newUsers" role="tab" aria-controls="nav-newUsers" aria-selected="true">NewUsers</a>
      <a class="nav-item nav-link" id="nav-members-tab" data-toggle="tab" href="#nav-members" role="tab" aria-controls="nav-members" aria-selected="false">Members</a>
      <a class="nav-item nav-link" id="nav-teachers-tab" data-toggle="tab" href="#nav-teachers" role="tab" aria-controls="nav-teachers" aria-selected="false">Teachers</a>
      <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false">Pending</a>
      <a class="nav-item nav-link" id="nav-declined-tab" data-toggle="tab" href="#nav-declined" role="tab" aria-controls="nav-declined" aria-selected="false">Declined</a>
    </nav>
  </div>

  <div class="card-body">
    <div class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade show active" id="nav-newUsers" role="tabpanel" aria-labelledby="nav-newUsers-tab">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <h1>New Registrations <span class="muted-text">({{$newUsers->count() }})</span></h1>
          <ul class="list-group">
            @foreach ($newUsers as $user)
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    {{ $user->last_name . ', ' . $user->first_name }}
                  </div>
                  <div class="col text-right">
                    <a href="/shomer/{{ $user->id }}/teacher" role="button" class="btn btn-outline-primary">Teacher</a>
                    <a href="/shomer/{{ $user->id }}/member" role="button" class="btn btn-success">Member</a>
                    <a href="/shomer/{{ $user->id }}/pending" role="button" class="btn btn-secondary">Pending</a>
                    <a href="/shomer/{{ $user->id }}/declined" role="button" class="btn btn-danger">Decline</a>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>  <!-- END newUsers-->

    <div class="tab-pane fade" id="nav-members" role="tabpanel" aria-labelledby="nav-members-tab">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <h1>Members <span class="muted-text">({{$members->count() }})</span></h1>
          <ul class="list-group">
            @foreach ($members as $user)
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    {{ $user->last_name . ', ' . $user->first_name }}
                  </div>
                  <div class="col text-right text-muted">
                    assigned by {{ $user->assignedBy }}
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>  <!-- END member-->

    <div class="tab-pane fade" id="nav-teachers" role="tabpanel" aria-labelledby="nav-teachers-tab">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <h1>Teachers <span class="muted-text">({{$teachers->count() }})</span></h1>
          <ul class="list-group">
            @foreach ($teachers as $user)
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    {{ $user->last_name . ', ' . $user->first_name }}
                  </div>
                  <div class="col text-right text-muted">
                    assigned by {{ $user->assignedBy }}
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>  <!-- END teacher-->

    <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <h1>Pending <span class="muted-text">({{$pending->count() }})</span></h1>
          <ul class="list-group">
            @foreach ($pending as $user)
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    {{ $user->last_name . ', ' . $user->first_name }}
                  </div>
                  <div class="col text-right text-muted">
                    assigned by {{ $user->assignedBy }}
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>  <!-- END pending-->

    <div class="tab-pane fade" id="nav-declined" role="tabpanel" aria-labelledby="nav-declined-tab">
      <div class="row justify-content-md-center">
        <div class="col-10">
          <h1>Declined <span class="muted-text">({{$declined->count() }})</span></h1>
          <ul class="list-group">
            @foreach ($declined as $user)
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    {{ $user->last_name . ', ' . $user->first_name }}
                  </div>
                  <div class="col text-right text-muted">
                    assigned by {{ $user->assignedBy }}
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div> <!-- END declined-->

    </div>
  </div>
</div>
@endsection
