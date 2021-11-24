@extends('frontend.layouts.master')

@section('head')
<title>{{ $product->slug }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css" integrity="sha512-CB+XYxRC7cXZqO/8cP3V+ve2+6g6ynOnvJD6p4E4y3+wwkScH9qEOla+BTHzcwB4xKgvWn816Iv0io5l3rAOBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script src="{{ asset('js/lightslider.js') }}" defer></script>
<script src="{{ asset('js/fiterByPrice.js') }}" defer></script>
<style>


    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center
    }

    .rating>input {
        display: none
    }

    .rating>label {
        /* position: relative; */
        margin-top: -100px;
        width: 1em;
        font-size: 30px;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }

    #wishlist {
        position: absolute;
        left: 170px;
        margin-top: -48px
    }

</style>
@endsection
@section('content')
<section class="content-header mt-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $product->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">E-commerce</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content mt-5">
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                    <div class="col-12">
                        <img src="{{ asset('Images-Product/'.$product->main_image) }}" class="product-image" alt="{{ $product->name }}">
                    </div>
                    <div class="col-12 product-image-thumbs">
                        @foreach (json_decode($product->images) as $img )
                        <div class="product-image-thumb"><img src="{{ asset('Images-Product/'.$img) }}" alt="{{ $product->title }}"></div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    @include('error.index')
                    @for ($i=1; $i<=5; ++$i) @if($avgRating< $i) @if(is_float($avgRating) && (round($avgRating)==$i)) {!! '<span class="material-icons">star_half</span>' !!} @else {!! '<span class="material-icons">star_outline</span>' !!} @endif @else {!! '<span class="material-icons">star</span>' !!} @endif @endfor <br>
                        ({{ $product->reviews->count() }}&nbsp;&nbsp; Reviews)
                        <h3 class="my-3 mt-5">{{ $product->title }}</h3>
                        <p>{{ $product->summary }}</p>
                        <hr>
                        <h4>Available Colors</h4>
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            @if($timerSales)
                            @if($product->sales && $timerSales->status && $timerSales->sale_date > Carbon\Carbon::now())
                            <input type="hidden" name="sales" value="{{ $product->sales }}">
                            @else
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            @endif
                            @else
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            @endif
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach ($product->options as $option)
                                @if($option->option_name=="color")
                                @foreach (unserialize($option->option_value) as $val)
                                <label class="btn btn-light text-center">
                                    <input class="form-check-input" value="{{ $val }}" type="radio" name="color">
                                    {{ $val }}
                                    <br>
                                    <i class="fas fa-circle fa-2x text-{{ $val }}"></i>
                                </label>
                                @endforeach
                                @endif
                                @endforeach
                            </div>
                            <h4 class="mt-3">Size <small>Please select one</small></h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($product->options as $option)
                                @if($option->option_name=="size")
                                @foreach (unserialize($option->option_value) as $val)
                                <label class="btn btn-light text-center">
                                    <input class="form-check-input" value="{{  $val }}" type="radio" name="size">
                                    <span class="text-xl">{{ $val }}</span>
                                    <br>
                                    @switch( $val)
                                    @case("S")
                                    Small
                                    @break
                                    @case("M")
                                    Medium
                                    @break
                                    @case("L")
                                    Large
                                    @break
                                    @case("XL")
                                    Xtra-Large
                                    @break
                                    @default
                                    @endswitch
                                </label>
                                @endforeach
                                @endif
                                @endforeach
                            </div>
                            <div class="bg-gray py-2 px-3 mt-4">
                                @if($timerSales )
                                <h2 class="mb-0">
                                    @if($product->sales && $timerSales->status && $timerSales->sale_date > Carbon\Carbon::now())
                                    Price:&nbsp;<s>${{ $product->price }}</s>
                                    ${{ $product->sales }}
                                    @else
                                    Price:${{ $product->price }}
                                    @endif
                                </h2>
                                @endif
                                <h3 class="mt-0">
                                    <small>{{ $product->sku == 0? "Stock Keep Unit is Empty Product Not Exist!":'Quantity Stock Keep Unit: '.$product->sku }} </small>
                                </h3>
                            </div>
                            @if($product->sku)
                            <button type="submit" class="btn btn-lg btn-primary mt-2"> <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Add To Cart</button>
                            @endif
                        </form>
                        <form action="{{ route('addToWishlist') }}" method="POST" id="wishlist">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-lg btn-dark"><i class="fa fa-heartbeat" aria-hidden="true"></i> Add To whislist</button>
                        </form>
                        <div class="mt-4 product-share">
                            <a href="#" class="text-gray">
                                <i class="fab fa-facebook-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fab fa-twitter-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fas fa-envelope-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fas fa-rss-square fa-2x"></i>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="false">Description</a>
                <a class="nav-item nav-link active" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="true">Specifications</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
            </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">{!! $product->descriptions !!}</div>
            <div class="tab-pane fade active show" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($product->options as $key=>$option )
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>
                                {{ $option->option_name }}
                            </td>
                            <td>
                                @foreach (unserialize($option->option_value) as $val)
                                {{ $val.'-' }}
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                @foreach ($product->reviews as $review )
                <div class="card">
                    <div class="card-header">
                        @if($review->user->profile->avatar)
                        <img class="img-fluid rounded" src="{{ asset('avatar-image/'.$review->user->profile->avatar) }}" alt="" width="70px">
                        @else
                        <img class="img-fluid rounded" src="{{ asset('backend/dist/img/avatar4.png') }}" alt="" width="70px">
                        @endif
                        <span class="mt-3">{{ $review->user->name }}</span>
                        <span class="ml-3">
                            @for ($i=1; $i<=5; ++$i) @if($review->rating< $i) @if(is_float($review->rating) && (round($review->rating)==$i))
                                    {!! '<span class="material-icons">star_half</span>' !!}
                                    @else
                                    {!! '<span class="material-icons">star_outline</span>' !!}
                                    @endif
                                    @else
                                    {!! '<span class="material-icons">star</span>' !!}
                                    @endif
                                    @endfor
                        </span>
                        <span class="float-right">{{ $review->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $review->comment }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $review->created_at->diffForHumans() }}
                    </div>
                </div>
                @endforeach
                <br>
                <br>
                <br>
                @if($orderItem!==null && $orderItem->order->delivered_date !==null && $orderItem->review_status==false)
                <div class="container">
                    <form action="{{ route('addReview',[$product->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name </label>
                                    <span class="required text-danger">*Optional</span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <span class="required text-danger">* Optional</span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Your Review</label>
                            <textarea class="form-control" name="comment" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <h6 class="mb-4">Your Rating</h6>
                        <div class="rating">
                            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 70px;margin-right:50px">leave Review</button>
                    </form>
                </div>
                @else
                <h6>For Leave an Review you should buy the Product ,get the product And Login to your Profile</h6>
                @endif
            </div>
        </div>
    </div>
</section>

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
                    @if($product->sales && $timerSales->status && $timerSales->sale_date > Carbon\Carbon::now())
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
                        @for ($i=1; $i<=5; ++$i) @if($avgRating< $i) @if(is_float($avgRating) && (round($avgRating)==$i)) {!! '<span class="material-icons">star_half</span>' !!} @else {!! '<span class="material-icons">star_outline</span>' !!} @endif @else {!! '<span class="material-icons">star</span>' !!} @endif @endfor </div>
                    </div>
                </div>
        </li>
        @endforeach
    </ul>
</section>
@endsection


@section('scripts')
<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('backend/dist/js/demo.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })

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
