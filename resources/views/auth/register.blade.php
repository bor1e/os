@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card mt-4">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <p>Please note, that we are going to review all applications, for this educational plattform. Until your application has been approved, your use of our services is limited. In order to make the process as short and easy as possible, please provide authentical information. If you enter wrong details, we may discard your registration.</p>
                        <div class="form-check{{ $errors->has('gender') ? ' has-error' : '' }}">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                          Male
                          </label>
                          @if ($errors->has('gender'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('gender') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-check{{ $errors->has('gender') ? ' has-error' : '' }}">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                            Female
                          </label>
                        </div>
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-check{{ $errors->has('member_of_jewish_community') ? ' has-error' : '' }}">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="yes_member" id="yes_member" value="yes_member">
                          Yes
                          </label>
                          @if ($errors->has('member_of_jewish_community'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('member_of_jewish_community') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-check{{ $errors->has('member_of_jewish_community') ? ' has-error' : '' }}">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="member_of_jewish_community" id="not_member" value="not_member">
                            No
                          </label>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                          <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
