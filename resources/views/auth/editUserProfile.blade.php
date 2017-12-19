
  <!-- form user info -->
  <div class="card card-outline-secondary mt-5">
    <div class="card-header">
      <h3 class="mb-0">Course Information</h3>
    </div>
  <div class="card-body">
    <form class="form" role="form" action="/profile" method="post" autocomplete="off">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">First Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Last Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Gender</label>
        <div class="col-lg-9">
          <select name="gender" class="form-control" size="0">
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">City</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="city" value="{{ $user->city }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Language</label>
        <div class="col-lg-9">
          <select name="language" class="form-control" size="0">
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
          <label class="col-lg-3 col-form-label form-control-label">Facebook-Profile</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="facebook" value="{{ $user->facebook }}">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Titel</label>
          <div class="col-lg-9">
            <select name="title" class="form-control" size="0">
              <option value="hr">Herr</option>
              <option value="fr">Frau</option>
              <option value="rav">Rabbiner</option>
              <option value="rbz">Rebbezin</option>
            </select>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Birthday</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="birthday" value="{{ $user->birthday }}" placeholder="27.08.1990">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Phone</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" placeholder="+49 171 1234567">
          </div>
      </div>

      <div class="row">
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Update Profile</button>
        </div>
      </div>

    </form>
  </div>
</div>
