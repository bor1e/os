<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="has-navbar-fixed-top">
<head>
  @include('meta')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
  <style>
    .bsad {
      position: relative;
      font-size: 8px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      left: 1rem;
      right: .2rem;
      bottom: 1rem;
    }
  </style>
</head>
<body>
  @include('nav')

  @yield('main')

</body>
</html>
