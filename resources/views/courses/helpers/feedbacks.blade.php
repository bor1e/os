@cannot('addFeedback')
  <ul class="list-group">
    <li class="list-group-item list-group-item-warning">
    @if (!Auth::check())
      <p class="mt-3">Please <a href="{{route('login') }}">sign in</a> to give a feedback, or ask a question.</p>
    @elseif (Auth::user()->hasRole('pending'))
      Please Update your User Information, in order to be approved by the Admins.
    @elseif (Auth::user())
      We are reviewing your registration, we will notify you, when the process is finished. You are welcome to <a href="/abouts-us#contact">contact</a> us.
    @endif
    </li>
  </ul>
@endcannot
<h1>
  Discussion
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
@can('addFeedback')
  <div class="row mt-3">
    <div class="col-8">
      <div class="card">
        <form method="POST" action="{{ $course->path() . '/feedback' }}">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="form-group">
              <textarea class="form-control" name="body" id="body" rows="3" placeholder="Leave a Feedback"></textarea>
            </div>
          </div>
          <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endcan
