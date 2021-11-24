@extends('frontend.layouts.master')


@section('head')
<title>Cart</title>
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script src="{{ asset('js/lightslider.js') }}" defer></script>
<style>

</style>
@endsection


@section('content')
<div class="container mt-5 p-3 rounded cart">
    <div class="row no-gutters">
        <div class="col-md-8">
            <div class="product-details mr-2">
                <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span class="ml-2"><a href="{{ route('products.index') }}">Continue Shopping</a></span></div>
                <hr>
                @include('error.index')
                    <h6 class="mb-0">Shopping cart</h6>
                @if(Cart::count() > 0)
                <div class="d-flex justify-content-between">
                    <span>You have {{ Cart::count() }} items in your cart</span>
                </div>
                @foreach (Cart::content() as $item )
                <div class="item d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                    <div class="d-flex flex-row">
                        <a href="{{ route('product.singleShow',[$item->id,$item->model->slug]) }}">
                            <img class="rounded" src="{{ asset('Images-Product/'.json_decode($item->model->images)[0]) }}" width="40">
                        </a>
                        <a href="{{ route('product.singleShow',[$item->id,$item->model->slug]) }}" style="text-decoration: none">
                            <div class="ml-2"><span class="font-weight-bold d-block">{{ $item->name }}</span>
                                <span class="spec">
                                    @foreach ($item->options as $option )
                                    {{ $option."-" }}
                                    @endforeach
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div class="col-md-4">
                            <label for="quantity">Quantity:</label>
                            <input class="form-control quantity" data-id="{{ $item->rowId }}" value="{{ $item->qty }}" type="number" min="1" class="form-control quantity-input">
                        </div>
                        <div class="col-md-4">
                            <span class="d-block ml-5 font-weight-bold">
                                @if($item->model->sales)
                                ${{$item->subtotal() }}
                                @else
                                ${{$item->subtotal() }}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light ml-3">
                                    <i class="fa fa-trash-o text-black-50" style="color: red !important"></i>&nbsp; remove
                                </button>
                            </form>
                            <br>
                            <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-light ml-3">
                                    <i class="fa fa-floppy-o" aria-hidden="true" style="color: blueviolet"></i>&nbsp; Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="d-flex justify-content-between">
                    <span>Your Shopping Cart is Empty</span>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="payment-info">
                <div class="d-flex justify-content-between align-items-center"><span>Cart details</span>
                    @if(Auth::user())
                        @if(Auth::user()->profile->avatar)
                            <img class="rounded" src="{{ asset('avatar-image/'.Auth::user()->profile->avatar) }}" width="30">
                        @else
                            <img class="rounded" src="{{ asset('backend/dist/img/avatar3.png') }}" width="30">
                        @endif
                    @else
                        <img class="rounded" src="{{ asset('backend/dist/img/avatar3.png') }}" width="30">
                    @endif
                </div><span class="type d-block mt-3 mb-1">
                    Card type</span><label class="radio"> <input type="radio" name="card" value="payment" checked> <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png" /></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png" /></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png" /></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png" /></span> </label>
                <hr class="line">
                <div class="d-flex justify-content-between information"><span>Subtotal</span><span>${{ Cart::subtotal() }}</span></div>
                <div class="d-flex justify-content-between information"><span>Tax(10%)</span><span>${{ Cart::tax() }}</span></div>
                <div class="d-flex justify-content-between information"><span>Total(Incl. taxes)</span><span>${{ Cart::total() }}</span>
                </div>
                @if(Auth::user())
                <a name="" id="" class="btn btn-primary btn-block d-flex justify-content-between mt-3" href="{{ route('checkout.index') }}" role="button"><span>Checkout</span></a>
                @else
                <a name="" id="" class="btn btn-primary btn-block d-flex justify-content-between mt-3" href="{{ route('login') }}" role="button"><span>For checkout you Should login</span></a>
                @endif
                <a name="" id="" class="btn btn-primary btn-block d-flex justify-content-between" href="{{ route('products.index') }}" role="button"><span>Continue Shopping</span></a>
            </div>
        </div>
    </div>
</div>

<!-- section save for later -->
<div class="container mt-5 p-3 rounded cart">
    <div class="row no-gutters">
        <div class="col-md-12">
            <div class="product-details mr-2">
                <hr>
                <h3 class="mb-0">Saved Items for later</h3>
                @if(Cart::instance('saveForLater')->count() > 0)
                <div class="d-flex justify-content-between">
                    <span>{{ Cart::instance('saveForLater')->count() }} items saved for Later</span>
                </div>
                @foreach (Cart::instance('saveForLater')->content() as $item )
                <div class="item d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                    <div class="d-flex flex-row">
                        <a href="{{ route('product.singleShow',[$item->id,$item->model->slug]) }}">
                            <img class="rounded" src="{{ asset('Images-Product/'.json_decode($item->model->images)[0]) }}" width="40">
                        </a>
                        <a href="{{ route('product.singleShow',[$item->id,$item->model->slug]) }}" style="text-decoration: none">
                            <div class="ml-2"><span class="font-weight-bold d-block">{{ $item->name }}</span>
                                <span class="spec">
                                    @foreach ($item->options as $option)
                                    {{ $option.'-' }}
                                    @endforeach
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div class="col-md-4 quantity">
                            <label for="quantity">Quantity:</label>
                            <input id="quantity" type="number" value="1" class="form-control quantity-input">
                        </div>
                        <div class="col-md-4">
                            <span class="d-block ml-5 font-weight-bold">
                                @if($item->model->sales)
                                ${{$item->model->sales }}
                                @else
                                ${{$item->price }}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light ml-3">
                                    <i class="fa fa-trash-o text-black-50" style="color: red !important"></i>&nbsp; Remove
                                </button>
                            </form>
                            <br>
                            <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-light ml-3">
                                    <i class="fa fa-floppy-o" aria-hidden="true" style="color: blueviolet"></i>&nbsp; Move
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="d-flex justify-content-between">
                    <span>you have no the Items save for later</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- you might also like this Products -->
<div class="container">
    <div class="section-title">
        <h2>
            <h2>You might Also Like</h2>
        </h2>
    </div>
</div>
<section class="slider">
    <ul id="autoWidth" class="cs-hidden">
        <!--1------------------------------------>
        @foreach ($mightAlsoLike as $product )
        <li class="item-a">
            <div class="box">
                <div class="slide-img">
                    <img alt="{{ $product->name }}" src="{{ asset('Images-Product/'.$product->main_image) }}">
                    @if($timerSales)
                    @if($product->sales && $timerSales->sale_date > Carbon\Carbon::now())
                    <span id="sales" class="badge badge-pill badge-warning">sales</span>
                    @endif
                    @endif
                    @if((Carbon\Carbon::parse($product->published_at)->diffInDays() - Carbon\Carbon::parse(now())->diffInDays()) <=7) <span id="new" class="badge badge-pill badge-success">New</span>
                        @endif
                        @if($product->featured)
                        <span id="hot" class="badge badge-pill badge-danger">Hot</span>
                        @endif
                        @if($product->status=='Soon')
                        <span id="soon" class="badge badge-pill badge-primary">Soon</span>
                        @endif
                        <div class="overlay">
                            <a href="{{ route('product.singleShow', [$product->id, $product->slug]) }}" class="buy-btn">Buy Now</a>
                            <a href="{{ route('product.singleShow', [$product->id, $product->slug]) }}" class="buy-btn">More Details</a>
                        </div>
                </div>
                <div class="d-flex align-items-start flex-column">
                    <div class="type pl-2 pr-2 pb-2 pt-3">
                        <a href="{{ route('product.singleShow', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                    </div>
                    <div class="pl-2 pr-2 pb-2 pt-1">
                        <div class="d-flex align-items-start">
                            <div class="type">
                                <span>{{Str::limit($product->summary, 20, '...')  }}</span>
                            </div>
                            <div class="price pl-3">
                                @if ($timerSales)
                                @if($product->sales && $timerSales->status && $timerSales->sale_date > Carbon\Carbon::now())
                                    <span>${{ $product->sales }}</span>
                                    <span><s>${{ $product->price }}</s></span>
                                @else
                                    <span>${{ $product->price }}</span>
                                @endif
                            @else
                                <span>${{ $product->price }}</span>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="pl-2 pr-2 pb-2 -pt-3">
                        @php
                            $avgRating =$product->reviews->avg('rating')
                        @endphp
                        @for ($i=1; $i<=5; ++$i)
                            @if($avgRating< $i)
                                @if(is_float($avgRating) && (round($avgRating)==$i))
                                    {!! '<span class="material-icons">star_half</span>' !!}
                                @else
                                    {!! '<span class="material-icons">star_outline</span>' !!}
                                @endif
                            @else
                                {!! '<span class="material-icons">star</span>' !!}
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#autoWidth').lightSlider({
            autoWidth: true
            , loop: true
            , onSliderLoad: function() {
                $('#autoWidth').removeClass('cS-hidden');
            }
        });
    });

</script>
@endsection
