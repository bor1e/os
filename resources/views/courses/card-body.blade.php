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
  <h4><a href="#{{ $course->teacher()->last_name }}">{{ $course->teacher()->title .' '. $course->teacher()->last_name  . ', ' . $course->teacher()->first_name }}</a></h4>
  <p class="card-text">
    <ul>
      <li>Email: {{ $course->teacher()['email'] }}</li>
      <li>City: {{ $course->teacher()['city'] }}</li>
    </ul>
  </p>
  <a href="fb.com/{{ $course->teacher()['social'] }}" class="btn btn-primary">Follow on Facebook</a>
</div>
