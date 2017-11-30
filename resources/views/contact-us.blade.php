<form method="POST" action="{{ route('contact') }}">
  {{ csrf_field() }}


  @if ($errors->has('name'))
      <div class="error">{{ $errors->first('firstname') }}</div>
  @endif
<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Name</label>
  </div>
  <div class="field-body">
    <div class="field">
      <p class="control is-expanded has-icons-left">
        <input class="input" name="name" type="text" placeholder="Name" required>
        <span class="icon is-small is-left">
          <i class="fa fa-user"></i>
        </span>
      </p>
    </div>
    <div class="field">
      <p class="control is-expanded has-icons-left has-icons-right">
        <input class="input" name="email" type="email" placeholder="Email"
          placeholder="youremail@gmail.com" required>
        <span class="icon is-small is-left">
          <i class="fa fa-envelope"></i>
        </span>
      </p>
    </div>
  </div>
</div>



<div class="field is-horizontal">
  <div class="field-label">
    <label class="label">Phone</label>
  </div>
  <div class="field-body">
    <div class="field is-expanded">
      <div class="field has-addons">
        <p class="control is-expanded">
          <input class="input" name="phone" type="tel" placeholder="Your phone number">
        </p>
      </div>
      <p class="help">Please include also the area code</p>
    </div>
  </div>
</div>


<div class="field is-horizontal">
  <div class="field-label">
    <label class="label">Already a member?</label>
  </div>
  <div class="field-body">
    <div class="field is-narrow">
      <div class="control">
        <label class="radio">
          <input type="radio" name="ismember">
          Yes
        </label>
        <label class="radio">
          <input type="radio" name="nomember">
          No
        </label>
      </div>
    </div>
  </div>
</div>

<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Subject</label>
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
        <input class="input" name="subject" type="text" placeholder="e.g. Partnership opportunity" required>
      </div>
      <p class="help">
        This field is required
      </p>
    </div>
  </div>
</div>

<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Message</label>
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
        <textarea class="textarea" name="message" placeholder="Explain how we can help you" required></textarea>
      </div>
    </div>
  </div>
</div>
<div class="field is-horizontal">

  <div class="field-label">
    <!-- Left empty for spacing -->
  </div>
  <div class="field-body">
    <div class="columns has-text-justified">
      <div class="column">
        {!! Recaptcha::render() !!}
      </div>
      <div class="column">
        <button type="submit" class="button is-primary is-large" style="top:15%;">
          Send message
        </button>
      </div>
    </div>
  </div>
</div>
</form>


@if (count($errors->all()) > 0)
  <div class="notification is-danger">
    <button class="delete"></button>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
