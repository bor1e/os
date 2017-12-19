@extends('layouts.app')

@section('content')
  @if (Auth::check())
    @include('auth.editUserProfile')
  @endif
@endsection
