@extends('layouts.app')

@section('content')
    {{$teacher->last_name}}<br>
    {{$teacher->profile->notes}}
@endsection
