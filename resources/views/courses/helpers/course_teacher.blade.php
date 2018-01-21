@if ($course->hasTeacher())
  <div class="tab-pane fade" id="nav-teacher-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-teacher-tab">
    <h4><a href="#{{ $course->teacher->last_name }}">{{ $course->teacher->profile->title .' '. $course->teacher->last_name }}</a></h4>
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
        <li>Email: {{ $course->teacher->email }}</li>
        <li>City: {{ $course->teacher->profile->city }}</li>
      </ul>
    </p>
    <p class="lead"><a href="/courses?by={{$course->teacher->last_name}}">Show all</a> <strong>Courses</strong> from this Teacher<p>
    <a href="fb.com/{{ $course->teacher->profile->social_profile }}" class="btn btn-primary">Follow on Facebook</a>
    @endcannot
  </div>
@endif
