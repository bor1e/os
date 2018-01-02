<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Free jewish educational plattform, subjects like Tora, Schabbat and Kaschrut and beyond are frequently discussed.">
    <meta name="KeyWords" content="tora, schabbat, jew, food, kaschrut, judaica, five books of mose, tanach, learning, free, education, free accessible">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/favicon.png" type="image/png" alt="onlineshiurim favicon" />

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <!--link href="{ { asset('css/app.css') }}" rel="stylesheet"-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="padding-bottom: 100px">
  <header class="header clearfix">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

      <a class="navbar-brand" href="{{ url('/') }}">
      <img src="/images/logo.png" width="90" height="30" style="margin-top:-5px" alt="OnlineShiurim: Live Shiurim, join experts from your living room">
          {{ config('app.name') }}
      </a>

      <span class="navbar-text ml-auto m-2 d-lg-none d-block">
        בס"ד
      </span>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mt-1">
            <div class="btn-group">
              <a href="/courses" class="btn btn-success">Courses</a>
              <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">    <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                @foreach ($channels as $channel)
                <a class="dropdown-item" href="/courses/{{$channel->name}}">{{$channel->name}}</a>
                @endforeach
              </div>
            </div>
          </li>
          <li class="nav-item  mt-1">
            <a class="nav-link" href="/about-us">About Us</a>
          <li class="nav-item  mt-1">
            <a class="nav-link" href="/faq">FAQ</a>
          </li>
          <li class="nav-item  mt-1">
            <a class="nav-link" href="/imprint">Imprint</a>
          </li>

          @if (Auth::check() && Auth::user()->can('manageUsers'))
          <li class="nav-item  mt-1">
            <a class="nav-link" href="/shomer/users">Users</a>
          </li>
          @endif

          @guest

          <form class="form-inline my-2 my-lg-0">
            <li class="nav-item">
              <button class="btn btn-outline-info btn-sm align-middle mr-2" type="button">
                <a class="nav-link" href="{{ route('login') }}"> <i class="fa fa-users"></i> Login</a>
              </button>
            </li>
            <li class="nav-item">
              <button class="btn btn-outline-success btn-sm align-middle" type="button">
                <a class="nav-link" href="{{ route('register') }}"> <i class="fa fa-sign-in"></i> Register</a>
              </button>
            </li>
          </form>

          @else

          <li class="nav-item mt-1 dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->first_name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href ="/profile">Edit Profile</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>

          @endguest

        </ul>
      </div>
      <span class="navbar-text d-lg-block d-none ml-2">
        בס"ד
      </span>
    </div>
  </nav>
</header>
<main role="main" class="container">
  @if (session()->has('message'))

  {{ session('message') }}
  @endif

  @yield('content')



</main>


    <!-- Scripts -->
    <!--script src="{ { asset('js/app.js') }}"></script-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
