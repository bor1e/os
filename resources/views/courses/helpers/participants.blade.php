<h1>Participants <span class="muted-text">({{ $course->users()->count() }})</span></h1>
<p>
  @can('participateInCourse')
    <ul class="list-group">
      @foreach ($course->users()->get() as $user)
        <li class="list-group-item">{{ $user->first_name . ', ' . substr($user->last_name, 0,1).'.' }}</li>
      @endforeach
    </ul>
  @endcan
</p>
