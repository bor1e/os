@cannot('participateInCourse')
 <ul class="list-group mt-3">
   <li class="list-group-item list-group-item-warning">
   @if (!Auth::check())
     <p class="mt-3">Please <a href="{{route('login') }}">sign in</a> to enroll and to participate in classes.</p>
   @elseif (Auth::user()->hasRole('pending'))
     Please <a href="/profile">update</a> your User Information, in order to be approved by the Admins.
   @elseif (!Auth::user()->hasRole('email_confirmed'))
     Please confirm your Email!
   @else
     <p class="lead">Please be passioned, while we are reviewing you <strong>registration</strong>. If the course you interested in, is about to start, feel free to <a href="/about-us#contact">contact</a> us.</p>
   @endif
   </li>
 </ul>
@endcannot
