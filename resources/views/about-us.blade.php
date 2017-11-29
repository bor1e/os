@extends('bulma')
@section('main')
<section class="section">
  <div class="container">
    <h1 class="title">The Project</h1>
    <h2 class="subtitle">Well, we just did it...</h2>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <article class="tile is-child box">
          <div class="content">
            <p class="title">How it works</p>
            <p class="subtitle">With even more content</p>

              <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                sea takimata sanctus est Lorem ipsum dolor sit amet.  Lorem
              </p>

              <p>
                ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                sea takimata sanctus est Lorem ipsum dolor sit amet.
              </p>

          </div>
        </article>
      </div>
      <div class="tile is-vertical is-8">
        <div class="tile">
          <div class="tile is-parent is-vertical">
            <article class="tile is-child notification is-warning">
              <p class="title">Students...</p>
              <p class="subtitle">Top tile</p>
              <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                sea takimata sanctus est Lorem ipsum dolor sit amet.  Lorem
              </p>
            </article>
            <article class="tile is-child notification is-success">
              <p class="title">Teachers</p>
              <p class="subtitle">Bottom tile</p>
              <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                sea takimata sanctus est Lorem ipsum dolor sit amet.  Lorem
              </p>
            </article>
          </div>
          <div class="tile is-parent">
            <article class="tile is-child notification is-info">
              <p class="title">Topics</p>
              <p class="subtitle">With an image</p>
              <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/640x480.png">
              </figure>
              <br>
              <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                aliquyam erat, sed diam voluptua. At vero eos et accusam et
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                sea takimata sanctus est Lorem ipsum dolor sit amet.  Lorem
              </p>
            </article>
          </div>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child box">
            <p class="title">Statistics</p>
            <p class="subtitle">last updated November 29, 2017</p>
            <div class="content">
              <div class="level is-mobile">
                <div class="level-item has-text-centered">
                  <div>
                    <p class="heading">Participants</p>
                    <p class="title">
                      <i class="fa fa-users" aria-hidden="true"></i>
                      5432
                    </p>
                  </div>
                </div>
                <div class="level-item has-text-centered">
                  <div>
                    <p class="heading">Classes</p>
                    <p class="title">
                      <i class="fa fa-video-camera" aria-hidden="true"></i>
                      456
                    </p>
                  </div>
                </div>
                <div class="level-item has-text-centered">
                  <div>
                    <p class="heading">Teachers</p>
                    <p class="title">
                      <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                      54
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h1 class="title">Meet our Team</h1>
    <h2 class="subtitle">
      This project is made only possible due to our <strong>amazing</strong>
      team, which is constantly working on improving our services.
    </h2>
  </div>
</section>

<section class="hero is-warning">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-2">
          <p class="image is-128x128">
            <img src="https://bulma.io/images/placeholders/128x128.png">
          </p>
        </div>
        <div class="column">
          <h1 class="title">Elyahu</h1>
          <h2 class="subtitle">Project Director</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content">
      <p>
        Making jewish <strong>learning</strong> and <strong>wisdom</strong> easy
        accessible to all, is the vision which Elyahu had in mind when he started
        the Project in the summer 2016 (Av 5776). Now Elyahu is primarly occupied in
        creating and organizing new learning schedules and lectures for german
        speaking jews, editing records and reinventing the learning experience for
        all.
      </p>
      <p>
        Studying Computer Science at the Friedrich-Alexander University, Elyahu has
        made experience what different educational platforms look like, and is
        currently creating a new website, allowing users to have a special learning
        experience and give teachers an easy way to communicate their message. If
        you are interested in helping Elyahu, just let him know use the contact form
          <a href="#contact">below</a>.
      </p>
    </div>
  </div>
</section>

<section class="hero is-success">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-2">
          <p class="image is-128x128">
            <img src="https://bulma.io/images/placeholders/128x128.png">
          </p>
        </div>
        <div class="column">
          <h1 class="title">Chana</h1>
          <h2 class="subtitle">Design Director</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content">
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
        clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
        amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
        nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
         diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
        Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
        sit amet.
      </p>
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
        clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
        amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
        nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
         diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
        Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
        sit amet.
      </p>
      </div>
  </div>
</section>

<section class="hero is-info">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-2">
          <p class="image is-128x128">
            <img src="https://bulma.io/images/placeholders/128x128.png">
          </p>
        </div>
        <div class="column">
          <h1 class="title">Yochewed</h1>
          <h2 class="subtitle">Russian Department Director</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content">
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
        clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
        amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
        nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
         diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
        Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
        sit amet.
      </p>
      <p>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
        voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
        clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
        amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
        nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
         diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
        Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
        sit amet.
      </p>
      </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h1 class="title">Contact Us</h1>
    <h2 class="subtitle">
      A simple way to stay get in touch!
    </h2>
    <div id="contact">
      @include('contact-us')
    </div>
  </div>
</section>
@endsection
