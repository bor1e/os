@extends('layouts.app')

@section('content')
    Welcome to the donation option: <br>

    <form action="{{route('donation')}}" method="POST">
        {{ csrf_field() }}
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_OVU8jG5n3vxDD0blhOHqytdB"
    data-amount="999"
    data-name="Chabad Lubawitsch Mittelfranken e.V."
    data-description="Example charge"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true"
    data-currency="eur">
  </script>
</form>
@endsection
