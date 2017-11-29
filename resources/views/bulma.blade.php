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

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {

// Get all "navbar-burger" elements
var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

  // Add a click event on each of them
  $navbarBurgers.forEach(function ($el) {
    $el.addEventListener('click', function () {

      // Get the target from the "data-target" attribute
      var target = $el.dataset.target;
      var $target = document.getElementById(target);

      // Toggle the class on both the "navbar-burger" and the "navbar-menu"
      $el.classList.toggle('is-active');
      $target.classList.toggle('is-active');

    });
  });
}

});
</script>
</body>
</html>
