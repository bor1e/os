@extends('layouts.app')

@section('content')
  @can('manageUsers')
  <!-- form user info -->
  <div class="card card-outline-secondary mt-5">
    <div class="card-header">
      <h3 class="mb-0">Teachers Profile</h3>
    </div>
  <div class="card-body">
    <form class="form" role="form" action="/shomer/teacher" method="post" autocomplete="off">
      {{ csrf_field() }}
      {{-- method_field('PUT') --}}
      <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Titel</label>
          <div class="col-lg-9">
            <select name="title" class="form-control" size="0">
             <option value="{{old('title')}}" {{ old('title') ? 'selected': ''}} >{{ old('title') }}</option>
              <option value="Herr">Herr</option>
              <option value="Frau">Frau</option>
              <option value="Rabbiner">Rabbiner</option>
              <option value="Rebbezin">Rebbezin</option>
              <option value="Herr Dr.">Herr Dr.</option>
              <option value="Frau Dr.">Frau Dr.</option>
              <option value="Herr Professor">Herr Professor</option>
              <option value="Frau Professorin">Frau Professorin</option>
            </select>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('first_name') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">First Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" required>
          @if ($errors->has('first_name'))
              <span class="help-block">
                  <strong>{{ $errors->first('first_name') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('last_name') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Last Name</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" required>
          @if ($errors->has('last_name'))
              <span class="help-block">
                  <strong>{{ $errors->first('last_name') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">E-mail</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="email" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('gender') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Gender</label>
        <div class="col-lg-9">
          <select name="gender" class="form-control" size="0" required>
            <option value="{{old('gender')}}" selected>{{title_case(old('gender'))}}</option>
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
      <div class="form-group row {{ $errors->has('salary') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Salary</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="salary" value="{{ old('salary') }}" required>
          @if ($errors->has('salary'))
              <span class="help-block">
                  <strong>{{ $errors->first('salary') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('city') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">City</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="city" value="{{ old('city') }}">
          @if ($errors->has('city'))
              <span class="help-block">
                  <strong>{{ $errors->first('city') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('country') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Country</label>
        <div class="col-lg-9">
          <input class="form-control" type="text" name="country" value="{{ old('country') }}">
          @if ($errors->has('country'))
              <span class="help-block">
                  <strong>{{ $errors->first('country') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('timezone') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Timezone</label>
        <div class="col-lg-9">
          <select name="timezone" class="form-control" size="0">
            <option value="{{old('timezone')}}" selected>{{old('timezone')}}</option>
            <option value="Europe/Berlin">Europe/Berlin</option>
            <option value="Europe/Moscow">Europe/Moscow</option>
            <option value="Europe/Kiev">Europe/Kiev</option>
            <option value="Asia/Jerusalem">Asia/Jerusalem</option>
          </select>
          @if ($errors->has('timezone'))
              <span class="help-block">
                  <strong>{{ $errors->first('timezone') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('language') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Language</label>
        <div class="col-lg-9">
          <select name="language" class="form-control" size="0">
            <option value="{{ old('language') }}" selected>{{ old('language') }}</option>
            <option value="de">deutsch</option>
            <option value="ru">русский</option>
            <option value="en">english</option>
            <option value="he">עברי</option>
          </select>
          @if ($errors->has('language'))
              <span class="help-block">
                  <strong>{{ $errors->first('language') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('social_profile') ? 'has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Social Profile</label>
          <div class="col-lg-9">
              <input class="form-control" type="text" name="social_profile" value="{{old('social_profile')}}">
              @if ($errors->has('social_profile'))
                  <span class="help-block">
                      <strong>{{ $errors->first('social_profile') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('birthday') ? 'has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Birthday</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="birthday" value="{{ old('birthday') }}" placeholder="27.08.1990">
            @if ($errors->has('birthday'))
                <span class="help-block">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('phone') ? 'has-error' : '' }}">
          <label class="col-lg-3 col-form-label form-control-label">Phone</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="+49 171 1234567">
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group row {{ $errors->has('quotes') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Favourite Quotes</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="5" name="quotes">{{ old('quotes') }}</textarea>
          @if ($errors->has('quotes'))
              <span class="help-block">
                  <strong>{{ $errors->first('quotes') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('hobbies') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Hobbies</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="5" name="hobbies">{{ old('hobbies') }}</textarea>
          @if ($errors->has('hobbies'))
              <span class="help-block">
                  <strong>{{ $errors->first('hobbies') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('message') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Message</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="5" name="message">{{ old('message') }}</textarea>
          @if ($errors->has('message'))
              <span class="help-block">
                  <strong>{{ $errors->first('message') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group row {{ $errors->has('notes') ? 'has-error' : '' }}">
        <label class="col-lg-3 col-form-label form-control-label">Notes</label>
        <div class="col-lg-9">
          <textarea class="form-control" type="text" rows="5" name="notes">{{ old('notes') }}</textarea>
          @if ($errors->has('Notes'))
              <span class="help-block">
                  <strong>{{ $errors->first('notes') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col text-right">
            <button type="submit" class="btn btn-success">Create Teacher Profile</button>
        </div>
      </div>

    </form>
  </div>
</div>
@endcan
@endsection
