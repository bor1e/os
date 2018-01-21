@if (Auth::check() && Auth::user()->can('participateInCourse') && Auth::user()->participates()->count())
<div class="col-2 mt-3 text-center">
    <h3 class="muted-text">Enrolled in Courses</h3>
    <ul class="list-group">
      @foreach (Auth::user()->participates()->get() as $course)
        <li class="list-group-item">
          <p class="small">
            <a href="{{$course->path()}}">{{ $course->title }}</a>
          </p>
        </li>
      @endforeach
    </ul>
</div>
<div class="col-9">
@else
  <div class="col-11">
@endif
