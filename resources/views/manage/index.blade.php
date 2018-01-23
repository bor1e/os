@extends('layouts.app')

@section('content')
<div class="card my-4">
  <!-- CARD HEADER -->
  <div class="card-header">
    <nav class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
      <a class="nav-item nav-link active" id="nav-email_confirmed-tab" data-toggle="tab" href="#nav-email_confirmed" role="tab" aria-controls="nav-email_confirmed" aria-selected="true">Confirmed</a>
      <a class="nav-item nav-link" id="nav-registered-tab" data-toggle="tab" href="#nav-registered" role="tab" aria-controls="nav-registered" aria-selected="false">Registered</a>
      <a class="nav-item nav-link" id="nav-members-tab" data-toggle="tab" href="#nav-members" role="tab" aria-controls="nav-members" aria-selected="false">Members</a>
      <a class="nav-item nav-link" id="nav-teachers-tab" data-toggle="tab" href="#nav-teachers" role="tab" aria-controls="nav-teachers" aria-selected="false">Teachers</a>
      <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false">Pending</a>
      <a class="nav-item nav-link" id="nav-declined-tab" data-toggle="tab" href="#nav-declined" role="tab" aria-controls="nav-declined" aria-selected="false">Declined</a>
    </nav>
  </div>

  <div class="card-body">
    <div class="tab-content" id="nav-tabContent">
        <!--{{ $show = true }}-->
        @foreach ($users as $roles => $roles_user)
            @if ($show)
                <div class="tab-pane fade show active" id="nav-{{$roles}}" role="tabpanel" aria-labelledby="nav-{{ $roles }}-tab">
                <!--{{ $show = false }}-->
            @else
                <div class="tab-pane fade" id="nav-{{$roles}}" role="tabpanel" aria-labelledby="nav-{{ $roles }}-tab">
            @endif

              <div class="row justify-content-md-center">
                <div class="col-10">
                  <h1>{{ studly_case($roles) }}<span class="muted-text">({{count($roles_user) }})</span></h1>
                  <ul class="list-group">
                    @foreach ($roles_user as $user)
                      <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                {{ $user->last_name . ', ' . $user->first_name }}
                            </div>
                            @if ($roles =='email_confirmed')
                            <div class="col text-right">
                              <a href="/shomer/{{ $user->id }}/member" role="button" class="btn btn-success">Member</a>
                              <a href="/shomer/{{ $user->id }}/teacher" role="button" class="btn btn-outline-primary">Teacher</a>
                              <!--a href="/shomer/{{-- $user->id --}}/email_confirmed" role="button" class="btn btn-outline-primary">Email Confirmed</a-->
                              <a href="/shomer/{{ $user->id }}/pending" role="button" class="btn btn-secondary">Pending</a>
                              <a href="/shomer/{{ $user->id }}/declined" role="button" class="btn btn-danger">Decline</a>
                            </div>
                            @endif
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
          </div>  <!-- END role-tabpanel -->
        @endforeach
    </div>
  </div>
</div>
@endsection
