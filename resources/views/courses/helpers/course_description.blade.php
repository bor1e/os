<div class="tab-pane fade" id="nav-description-{{ $course->id }}" role="tabpanel" aria-labelledby="nav-description-tab">
  <h4>Description</h4>
  <p class="card-text">{{ $course->body }}</p>
  <a href="{{ $course->path()}}" class="btn btn-primary">Details</a>
</div>
