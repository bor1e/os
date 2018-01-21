@extends('layouts.app')

@section('content')
  @can('update',$course)
        <!-- form user info -->
        <div class="card card-outline-secondary mt-5">
          <div class="card-header">
            <h3 class="mb-0">Course Information</h3>
          </div>
        <div class="card-body">
          <form class="form" role="form"action="{{$course->path() }}/edit" method="post" autocomplete="off">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
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
            <div class="form-group row {{ $errors->has('teacher_id') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label form-control-label">Teacher</label>
              <div class="col-lg-9">
                <select name="teacher_id" class="form-control" size="0" required>
                  <option value="">Choose one...</option>
                  @foreach ($teachers as $teacher)
                  <option value="{{$teacher->id}}" {{ $course->teacher_id==$teacher->id ? 'selected': ''}} >{{ $teacher->last_name . ' ' . $teacher->first_name }}</option>
                  @endforeach
                </select>
                @if ($errors->has('teacher_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('teacher_id') }}</strong>
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
            <div class="form-group row {{ $errors->has('date') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label form-control-label">Date</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="date" placeholder="29.01.2018" value="{{ $course->date->format('d.m.Y') }}" required>
                @if ($errors->has('date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group row {{ $errors->has('time') ? ' has-error' : '' }}">
              <label class="col-lg-3 col-form-label form-control-label">Time (Berlin)</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="time" placeholder="21:00" value="{{ substr($course->time, 0, 5) }}" required>
                @if ($errors->has('time'))
                    <span class="help-block">
                        <strong>{{ $errors->first('time') }}</strong>
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
            @if (Auth::user()->hasRole('manager'))
              <div class="form-group row {{ $errors->has('dedication') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Dedication</label>
                <div class="col-lg-9">
                  <textarea class="form-control" type="text" rows="5" name="dedication">{{ $course->dedication?$course->dedication : 'In loving memory ...' }}</textarea>
                  @if ($errors->has('dedication'))
                      <span class="help-block">
                          <strong>{{ $errors->first('dedication') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            @endif
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
                <label class="col-lg-3 col-form-label form-control-label">GoToMeeting Link</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="g2m_id" placeholder="https:/global.gotomeeting.com/join/123456789" value="{{ $course->g2m_id }}" required>
                    @if ($errors->has('g2m_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g2m_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('meetings') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Number of Meetings</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="meetings" placeholder="4" value="{{ $course->meetings }}" required>
                    @if ($errors->has('meetings'))
                        <span class="help-block">
                            <strong>{{ $errors->first('meetings') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('level') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Level</label>
                <div class="col-lg-9">
                    <select name="level" class="form-control" size="0">
                      <option value="{{ $course->level }}" selected>{{ $course->level ? $course->level : 'Select one...'  }}</option>
                      <option value="beginner">Beginner</option>
                      <option value="advanced">Advanced</option>
                      <option value="expert">Expert</option>
                    </select>
                    @if ($errors->has('level'))
                        <span class="help-block">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('cost') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Estimated Cost (in €)</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="cost" placeholder="50" value="{{ $course->cost }}">
                    @if ($errors->has('cost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cost') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('intervall') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Intervall</label>
                <div class="col-lg-9">
                  <select name="intervall" class="form-control" size="0">
                    <option value="{{ $course->intervall }}" selected>{{ $course->intervall ? $course->intervall : 'Select one...'  }}</option>
                    <option value="0">Once</option>
                    <option value="1">Everyweek</option>
                    <option value="2">Once in two weeks</option>
                    <option value="4">Monthly</option>
                  </select>
                  @if ($errors->has('intervall'))
                      <span class="help-block">
                          <strong>{{ $errors->first('intervall') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('notes') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Notes</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" name="notes" placeholder="#TODO:" value="{{ $course->notes }}">
                    @if ($errors->has('notes'))
                        <span class="help-block">
                            <strong>{{ $errors->first('notes') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('status') ? ' has-error' : '' }}">
                <label class="col-lg-3 col-form-label form-control-label">Status</label>
                <div class="col-lg-9">
                  <select name="status" class="form-control" size="0" required>
                    <option value="{{ $course->status }}" selected>{{ $course->status ? $course->status : 'Select one...'  }}</option>
                    <option value="pending">Pending</option>
                    <option value="canceled">Canceled</option>
                    <option value="published">Published</option>
                  </select>
                  @if ($errors->has('status'))
                      <span class="help-block">
                          <strong>{{ $errors->first('status') }}</strong>
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

  @endcan
@endsection
