
  <!-- form user info -->
  <div class="card card-outline-secondary mt-5">
    <div class="card-header">
      <h3 class="mb-0">Course Information</h3>
    </div>
  <div class="card-body">
    <form class="form" role="form"action="{{$course->path() }}/edit" method="post" autocomplete="off">
      {{ csrf_field() }}
      <div class="form-group row {{ $errors->has('channel_id') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Channel</label>
        <div class="col-lg-9">
          <select name="channel_id" class="form-control" size="0" required>
            <option value="">Choose one...</option>
            @foreach ($channels as $channel)
            <option value="{{$channel->id}}" {{ $course->channel_id==$channel->id ? 'selected': ''}} >{{ $channel->name }}</option>
            @endforeach
          </select>
          @if ($errors->has('channel_id'))
              <span class="help-block">
                  <strong>{{ $errors->first('channel_id') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Course Title</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="title" placeholder="New Lecture with excellent time" value="{{ $course->title }}">
          @if ($errors->has('title'))
              <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('datetimetz') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Datetime</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="datetimetz" placeholder="29.01.2018 21:30" value="{{ $course->datetimetz }}" required>
          @if ($errors->has('datetimetz'))
              <span class="help-block">
                  <strong>{{ $errors->first('datetimetz') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Description</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="2" name="description" required>{{ $course->description }}</textarea>
          @if ($errors->has('description'))
              <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('body') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Body</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="5" name="body" required>{{ $course->body }}</textarea>
          @if ($errors->has('body'))
              <span class="help-block">
                  <strong>{{ $errors->first('body') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Language</label>
        <div class="col-lg-9">
          <select name="language" class="form-control" size="0" required>
            <option value="{{ $course->language }}" selected>{{ $course->language ? $course->language : 'Select one...'  }}</option>
            <option value="de">Deutsch</option>
            <option value="ru">Russisch</option>
            <option value="en">Englisch</option>
            <option value="he">Hebräisch</option>
          </select>
          @if ($errors->has('language'))
              <span class="help-block">
                  <strong>{{ $errors->first('language') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('slug') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Slug</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="slug" placeholder="your-title-with-small-letters-and-with-bindestriche" value="{{ $course->slug }}" required>
              @if ($errors->has('slug'))
                  <span class="help-block">
                      <strong>{{ $errors->first('slug') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('g2m_id') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">GoToMeetingId</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="g2m_id" placeholder="123456789" value="{{ $course->g2m_id }}" required>
              @if ($errors->has('g2m_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('g2m_id') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('cycle') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Cycle</label>
          <div class="col-lg-9">
            <select name="cycle" class="form-control" size="0" required>
              <option value="{{ $course->cycle }}" selected>{{ $course->cycle ? $course->cycle : 'Select one...'  }}</option>
              <option value="0">Once</option>
              <option value="1">Everyweek</option>
              <option value="2">Once in two weeks</option>
              <option value="4">Monthly</option>
            </select>
            @if ($errors->has('cycle'))
                <span class="help-block">
                    <strong>{{ $errors->first('cycle') }}</strong>
                </span>
            @endif
          </div>
      </div>

      <div class="row">
        <div class="col text-right">
            <button  type="submit" class="btn btn-success">Update Course</button>
        </div>
      </div>

    </form>
  </div>
</div>
