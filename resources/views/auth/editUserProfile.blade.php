
  <!-- form user info -->
  <div class="card card-outline-secondary mt-5">
    <div class="card-header">
      <h3 class="mb-0">Course Information</h3>
    </div>
  <div class="card-body">
    <form class="form" role="form" action="/profile" method="post" autocomplete="off">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Titel</label>
          <div class="col-lg-9">
            <select name="title" class="form-control" size="0">
              <option value="hr">Herr</option>
              <option value="fr">Frau</option>
              <option value="rav">Rabbiner</option>
              <option value="rbz">Rebbezin</option>
            </select>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('first_name') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">First Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}" required>
          @if ($errors->has('first_name'))
              <span class="help-block">
                  <strong>{{ $errors->first('first_name') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('last_name') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Last Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" required>
          @if ($errors->has('last_name'))
              <span class="help-block">
                  <strong>{{ $errors->first('last_name') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('gender') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Gender</label>
        <div class="col-lg-9">
          <select name="gender" class="form-control" size="0" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          @if ($errors->has('gender'))
              <span class="help-block">
                  <strong>{{ $errors->first('gender') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('city') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">City</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="city" value="{{ $user->city }}">
          @if ($errors->has('city'))
              <span class="help-block">
                  <strong>{{ $errors->first('city') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('language') ? ' has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Language</label>
        <div class="col-lg-9">
          <select name="language" class="form-control" size="0">
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
      <div class="form-group row {{ $errors->has('facebook') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Facebook-Profile</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="facebook" value="{{ $user->facebook }}">
              @if ($errors->has('facebook'))
                  <span class="help-block">
                      <strong>{{ $errors->first('facebook') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('birthday') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Birthday</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="birthday" value="{{ $user->birthday }}" placeholder="27.08.1990">
            @if ($errors->has('birthday'))
                <span class="help-block">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Phone</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" placeholder="+49 171 1234567">
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
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
