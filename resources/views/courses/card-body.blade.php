<div class="tab-pane fade show active" id="nav-info-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-info-tab">
  <h4>{{$course->title}}</h4>
  <p class="card-text">{{ $course->description }}</p>
  @can('participateInCourse')
    @if ($course->participants()->where('user_id','=',Auth::id())->count())
      <div class="row">
        <div class="col">
          <a href="{{ $course->path()}}" class="btn btn-success" role="button">Details</a>
        </div>
        <div class="col">
          <form action="{{ $course->path() }}/revokeEnrollment" method="post">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Unroll</button>
          </form>
        </div>
      </div>
    @else
      <form action="{{ $course->path() }}/enroll" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">Enroll</button>
      </form>
    @endif
  @endcan
</div>

<div class="tab-pane fade" id="nav-description-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-description-tab">
  <h4>Description</h4>
  <p class="card-text">{{ $course->body }}</p>
  <a href="{{ $course->path()}}" class="btn btn-primary">Details</a>
</div>

@if ($course->hasTeacher())
  <div class="tab-pane fade" id="nav-teacher-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-teacher-tab">
    <h4><a href="#{{ $course->teacher()->last_name }}">{{ $course->teacher()->title .' '. $course->teacher()->last_name }}</a></h4>
    @cannot('participateInCourse')
      <ul class="list-group mt-3">
        <li class="list-group-item list-group-item-warning">
        @if (!Auth::check())
          <p class="mt-3">Please <a href="{{route('login') }}">sign in</a> to see more information about the teacher.</p>
        @elseif (Auth::user()->hasRole('pending'))
          Please Update your User Information, in order to be approved by the Admins.
        @endif
        </li>
      </ul>
    @else
    <p class="card-text">
      <ul>
        <li>Email: {{ $course->teacher()['email'] }}</li>
        <li>City: {{ $course->teacher()['city'] }}</li>
      </ul>
    </p>
    <a href="fb.com/{{ $course->teacher()['social'] }}" class="btn btn-primary">Follow on Facebook</a>
    @endcannot
  </div>
@endif
