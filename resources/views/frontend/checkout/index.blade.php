@extends('frontend.layouts.master')


@section('head')
<title>Checkout</title>
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<script src="https://js.stripe.com/v3/"></script>
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }

</style>
@endsection


@section('content')
<div class="container">
    <div class="py-5 text-center">
        <a class="navbar-brand text-white" href="{{ route('welcome') }}">
            <svg height="80px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" style="width: 100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="comp_x5F_194-laravel">
                    <polygon points="33,106 153,336 479,256 429,186 359,196 469,356 319,406 143,106    " style="fill:#F35045;" />
                    <g>
                        <path d="M319.001,416.001c-3.471,0-6.792-1.814-8.626-4.94l-53.019-90.373l-101.973,25.024      c-4.471,1.1-9.118-1.002-11.249-5.086l-120-230c-1.618-3.1-1.498-6.819,0.314-9.809C26.261,97.826,29.503,96,33,96h110      c3.548,0,6.83,1.88,8.625,4.94l115.439,196.772l128.113-31.438l-44.418-64.608c-1.96-2.851-2.308-6.513-0.918-9.682      c1.39-3.168,4.318-5.394,7.744-5.883l70-10c3.692-0.531,7.38,1.048,9.552,4.087l50,70c1.928,2.699,2.392,6.178,1.239,9.288      c-1.153,3.109-3.772,5.446-6.994,6.236l-53.324,13.086l49.182,71.537c1.78,2.589,2.24,5.864,1.241,8.843      c-0.998,2.979-3.339,5.315-6.319,6.31l-150,50C321.12,415.834,320.054,416.001,319.001,416.001z M277.626,315.714l45.899,78.237      l129.706-43.236l-45.939-66.821L277.626,315.714z M49.497,116l108.74,208.418l88.559-21.731L137.273,116H49.497z       M376.374,203.62l39.57,57.557l46.342-11.372l-37.89-53.046L376.374,203.62z" style="fill:#B63C34;" />
                    </g>
                </g>
                <g id="Layer_1" />
            </svg>
        </a>
        <h2>Checkout form</h2>
        <p class="lead">this is checkout form your cart please enter your info</p>
    </div>
    <div class="row">
        <div class="col-md-6 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-primary badge-pill">{{ Cart::count() }}</span>
            </h4>
            <ul class="list-group mb-1">
                <div class="payment-info mb-3">
                    <div class="d-flex justify-content-between align-items-center"><span>Cart details</span><img class="rounded" src="{{ asset('backend/dist/img/avatar.png') }}" width="30">
                    </div><span class="type d-block mt-3 mb-1">
                        Card type</span><label class="radio"> <input type="radio" name="card" value="payment" checked> <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png" /></span> </label>
                    <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png" /></span> </label>
                    <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png" /></span> </label>
                    <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png" /></span> </label>
                    @foreach (Cart::content() as $item )
                    <div class="item d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row">
                            <a href="{{ route('product.show',[$item->id,$item->model->slug]) }}">
                                <img class="rounded" src="{{ asset('Images-Product/'.json_decode($item->model->images)[0]) }}" width="40">
                            </a>
                            <a href="{{ route('product.show',[$item->id,$item->model->slug]) }}" style="text-decoration: none">
                                <div class="ml-2"><span class="font-weight-bold d-block" style="color: white">{{ $item->name }}</span>
                                    <span class="spec" style="color: white">
                                        @foreach ($item->options as $option )
                                        {{ $option."-" }}
                                        @endforeach
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div class="col-md-4 quantity">
                                <span>Quantity:{{ $item->qty }}</span>

                            </div>
                            <div class="col-md-4">
                                <span class="d-block ml-5 font-weight-bold">
                                    @if($item->subtotal)
                                    ${{$item->subtotal() }}
                                    @else
                                    ${{$item->subtotal() }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    <div class="d-flex justify-content-between information mt-5"><span>Subtotal</span><span>${{ Cart::subtotal() }}</span></div>
                    @if(session()->has('coupon'))
                    <div class="d-flex justify-content-between information">
                        <span>discount({{ Session()->get('coupon')['name']}}):
                            <form class="d-inline" action="{{ route('removeCoupon') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                </button>
                            </form>
                        </span>
                        <span class="mt-2">$-{{ $discount }}</span>
                    </div>
                    @endif
                    <hr class="line">
                    <div class="d-flex justify-content-between information"><span>New Subtotal </span><span>${{ $newSubtotal }}</span></div>
                    <div class="d-flex justify-content-between information"><span>Tax(10%)</span><span>${{ $newTax }}</span></div>
                    <div class="d-flex justify-content-between information"><span>Total(Incl. taxes)</span><span>${{ $newTotal }}</span>
                    </div>
                    <a name="" id="" class="btn btn-primary btn-block d-flex justify-content-between" href="{{ route('products.index') }}" role="button"><span>Continue Shopping</span></a>
                    <a name="" id="" class="btn btn-primary btn-block d-flex justify-content-between" href="{{ route('cart.index') }}" role="button"><span>Back To Cart</span></a>
                </div>
            </ul>
            @if(!session()->has('coupon'))
            <form method="POST" action="{{ route('addCoupon') }}" class="card p-2">
                @csrf
                @method('POST')
                <span>Have a code?</span>
                <div class="input-group">
                    <input type="text" class="form-control" name="coupon" id="coupon" placeholder="Discount Code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Apply</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
        <div class="col-md-6 order-md-1">
            @include('error.index')
            {{-- id="payment-form" --}}
            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form" class="needs-validation" novalidate="">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="{{ Auth::user()->name }}" readonly>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name">
                                <div class="invalid-feedback">
                                    Valid Last name is required.
                                </div>

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" value="{{ Auth::user()->email }}" readonly>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile">Mobile</label>
                            <input type="mobile" class="form-control" name="mobile" id="mobile" placeholder="your Mobile">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address1">Address</label>
                            <input type="text" class="form-control" name="address1" id="address" placeholder="1234 Main St" required="">
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" placeholder="Enetr Country">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zip">Post Code/Zip</label>
                                <input type="text" class="form-control" name="zip" id="zip" placeholder="zip Code">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city">Town/City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Enetr City">
                            </div>
                            <div class="col-md-6">
                                <label for="province">State</label>
                                <input type="text" class="form-control" name="province" id="province" placeholder="Enetr State">
                            </div>
                        </div>
                        <hr class="mb-4">
                        <h4 class="mb-3">Payment</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" value="credit" type="radio" class="custom-control-input">
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="cash" name="paymentMethod" value="cash" type="radio" class="custom-control-input" checked>
                                <label class="custom-control-label" for="cash">Cash on Delivery</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div id="credit-card" style="display: none">
                    @if(Session::has('stripe_error'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('stripe_error') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="card-element">
                                    Credit card
                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <div class="spacer"></div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit" id="complete-order" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Complete Order {{ $newTotal }}</button>
            </form>
            <hr class="mb-4">
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    // jQuery Validation Form slider
    $(document).ready(function() {
        $("#payment-form").validate({
            rules: {
                last_name: {
                    required: true
                    , minlength: 3
                , }
                , mobile: {
                    required: true
                , }
                , address1: {
                    required: true
                    , minlength: 3
                , }
                , country: {
                    required: true
                    , minlength: 3
                , }
                , province: {
                    required: true
                    , minlength: 3
                , }
                , city: {
                    required: true
                    , minlength: 3
                , }
                , zip: {
                    required: true
                    , number: true
                }
            , }
            , messages: {
                last_name: 'The last name field must be at least 3 characters and required.'
                , mobile: 'The mobile field required'
                , address1: 'The address field required.'
                , country: 'The country field must be beat least 3 characters and required'
                , province: 'The province field must be beat least 3 characters and required'
                , city: 'The city must be at least 3 characters and required'
                , zip: 'The zip code must be number and required'
            , }
        });
    });

</script>
@endsection
