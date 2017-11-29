<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        @include('meta')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .bsad {
              font-size: 12px;
              font-weight: 600;
              letter-spacing: .1rem;
              text-decoration: none;
                position: absolute;
                right: 18px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 12.5vw;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            footer {
              position: absolute;
              left: 18px;
              bottom: 18px;
            }

            footer > a {
                 color: #636b6f;
                 padding: 0 20px;
                 font-size: 10px;
                 font-weight: 600;
                 letter-spacing: .1rem;
                 text-decoration: none;
                 text-transform: uppercase;
             }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
          <div class="bsad">
            בס"ד
          </div>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    @else
                      <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    OnlineShiurim
                </div>


                <div class="links">
                    <a href="https://goo.gl/U4pTR1">Deutsch</a>
                    <a href="https://goo.gl/G8mC94">Русский</a>
                    <a href="https://goo.gl/Rv3AJE">English</a>
                </div>

                <div class="donation">
                </div>
            </div>

            <footer>
              <a href="/about-us#contact">Contact Us</a>
              <a href="/about-us">About Us</a>
              <a href="/faq">FAQ</a>
              <a href="/imprint">Imprint</a>
            </footer>
        </div>
    </body>
</html>
