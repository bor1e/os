<div class="tab-pane fade show active" id="nav-info-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-info-tab">

  <h4>{{$course->title}}</h4>

  <p class="h5 mr-auto"><span class="badge badge-primary">{{ array('Sonntag','Montag', 'Dienstag', 'Mittwoch','Donnerstag', 'Freitag','Samstag')[date('w', strtotime($course->date))] .' ('.date('d.m', strtotime($course->date)).'), um ' .substr($course->time, 0, 5)  }}</span></p>

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
