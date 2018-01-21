@extends('layouts.app')

@section('content')
  @can('manageUsers')
     <ul class="list-group list-group-flush">
        <button type="button" name="button"><a href="{{route('teacher.create')}}">Create Teacher</a></button>
        @foreach ($teachers as $index => $teacher)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <button type="button" name="button"><a href="/shomer{{$teacher->path()}}/edit">Edit Teacher</a></button>
            <a href="{{ $teacher->path() }}">{{ $teacher->profile->title . ' ' . $teacher->last_name . ', ' . $teacher->first_name }}</a>
            <button type="button" name="button">Send Email</button>
        </li>
        @endforeach
    </ul>
  @endcan
@endsection
