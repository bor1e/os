<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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

<section class="hero is-primary is-fullheight">
  <!-- Hero head: will stick at the top -->
  <div class="hero-head">
    @include('nav-alt')
  </div>

  <!-- Hero content: will be in the middle -->
  <div class="hero-body">
    <div class="container has-text-centered">
      <img src="/images/logo.png" style="height:15rem;" alt="Logo OnlineShiurim" />
      <h1 class="title">
        OnlineShiurim
      </h1>
      <h2 class="subtitle">Choose lectures:</h2>

        <div class="buttons is-centered">
            <a class="button is-primary is-inverted is-outlined" href="https://goo.gl/U4pTR1">Deutsch</a>
            <a class="button is-primary is-inverted is-outlined" href="https://goo.gl/G8mC94">Русский</a>
            <a class="button is-primary is-inverted is-outlined" href="https://goo.gl/Rv3AJE">English</a>
        </div>





    </div>
  </div>


  <div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/faq">FAQ</a></li>
          <li><a href="/imprint">Imprint</a></li>
          <li><a href="/about-us#contact">Contacts Us</a></li>
          <li><a href="#">Donate</a></li>
        </ul>
      </div>
    </nav>
  </div>
</section>
</body>
</html>
