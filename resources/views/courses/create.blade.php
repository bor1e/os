@extends('layouts.app')

@section('content')
  @can('create', App\Course::class)
    @include('courses.createCourseForm')
  @endcan
@endsection
