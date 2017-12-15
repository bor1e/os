<h1>
  Feedbacks
</h1>
@foreach ($course->feedbacks()->get() as $index => $feedback)
  <div class="row">
    <div class="col-8">
      <div class="card">
        <div class="card-header text-muted">
          <div class="row">
            <div class="col-2">
              # {{ $index+1 }} {{ $feedback->user()->first_name }}
            </div>
            <div class="col-10 text-right">
                {{ $feedback->created_at->diffForHumans() }}
            </div>
          </div>
        </div>
        <div class="card-body">
          <p class="card-text">
            {{ $feedback->body }}
          </p>
        </div>
      </div>
    </div>
  </div>
@endforeach
