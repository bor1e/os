@extends('layouts.app')

@section('content')
  @can('update',$course)
    @include('courses.editCourseForm')
  @endcan
@endsection
