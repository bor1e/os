
  <!-- form user info -->
  <div class="card card-outline-secondary mt-5">
    <div class="card-header">
      <h3 class="mb-0">Course Information</h3>
    </div>
  <div class="card-body">
    <form class="form" role="form"action="{{$course->path() }}/edit" method="post" autocomplete="off">
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Course Title</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="title" value="{{ $course->title }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Datetime</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="datetimetz" value="{{ $course->datetimetz }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Description</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="2" name="description">{{ $course->description }}</textarea>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Body</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="5" name="body">{{ $course->body }}</textarea>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Language</label>
        <div class="col-lg-9">
          <select name="language" class="form-control" size="0">
            <option value="{{ $course->language }}" selected>{{ $course->language }}</option>
            <option value="de">Deutsch</option>
            <option value="ru">Russisch</option>
            <option value="en">Englisch</option>
            <option value="he">Hebräisch</option>
          </select>
        </div>
      </div>
      <!--div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Time Zone</label>
        <div class="col-lg-9">
          <select id="user_time_zone" class="form-control" size="0">
            <option value="Hawaii">(GMT-10:00) Hawaii</option>
            <option value="Alaska">(GMT-09:00) Alaska</option>
            <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
            <option value="Arizona">(GMT-07:00) Arizona</option>
            <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
          </select>
        </div>
      </div-->
      <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Slug</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="slug" value="{{$course->slug }}">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">GoToMeetingId</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="g2m_id" placeholder="123456789" value="{{ $course->g2m_id }}">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Cycle</label>
          <div class="col-lg-9">
            <select name="cycle" class="form-control" size="0">
              <option value="{{ $course->cycle }}" selected>{{ $course->cycle }}</option>
              <option value="0">Once</option>
              <option value="1">Everyweek</option>
              <option value="2">Once in two weeks</option>
              <option value="4">Monthly</option>
            </select>
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
