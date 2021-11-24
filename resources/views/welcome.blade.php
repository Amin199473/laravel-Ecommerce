@extends('frontend.layouts.master')


<!-- head-tags  -->
@section('head')
<title>{{ $setting->site_title }}</title>
<!-- lightslider  Assets  files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script src="{{ asset('js/lightslider.js') }}" defer></script>
<meta name="description" content="{{ $setting->site_description }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('Images/AcA2LnWL_400x400.jpg') }}" type="image/icon type">
@endsection

<!-- content Page -->
@section('content')
<!-- slider section -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @foreach ($sliders as $key=>$slider )
        <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
            <img class="d-block w-100" src="{{ asset('slider-image/'.$slider->image) }}" alt="First slide" style="height: 600px">
            <div class="carousel-caption">
                {{-- --}}
                <h5 class="animate__animated animate__bounceInRight" style="animation-delay: 1s">{{ $slider->title }}</h5>
                <p class="animate__animated animate__bounceInLeft" style="animation-delay: 2s"><h5>{!! $slider->subtitle !!}</h5></p>
                <p class="animate__animated animate__bounceInUp" style="animation-delay: 3s"><a href="{{ $slider->link_button }}">{{ $slider->button }}</a></p>
            </div>
        </div>
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!-- featured section  -->
<div class="untree_co-section py-4 bg-light">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-12 col-sm-6 col-md-4 mb-3 mb-md-0">
                <div class="feature h-100">
                    <div class="icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5v7h-1v-7a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5v1A1.5 1.5 0 0 1 0 10.5v-7zM4.5 11h6v1h-6v-1z"></path>
                            <path fill-rule="evenodd" d="M11 5h2.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5h-1v-1h1a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4.5h-1V5zm-8 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                            <path fill-rule="evenodd" d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                        </svg>
                    </div>
                    <h3>Worldwide Delivery</h3>
                    <p>Far far away, behind the word mountains, far from the countries.</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3 mb-md-0">
                <div class="feature h-100">
                    <div class="icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-lock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z"></path>
                            <path d="M9.5 6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                            <path d="M7.411 8.034a.5.5 0 0 1 .493-.417h.156a.5.5 0 0 1 .492.414l.347 2a.5.5 0 0 1-.493.585h-.835a.5.5 0 0 1-.493-.582l.333-2z"></path>
                        </svg>
                    </div>
                    <h3>Secure Payments</h3>
                    <p>Far far away, behind the word mountains, far from the countries.</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3 mb-md-0">
                <div class="feature h-100">
                    <div class="icon">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-counterclockwise" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.83 6.706a5 5 0 0 0-7.103-3.16.5.5 0 1 1-.454-.892A6 6 0 1 1 2.545 5.5a.5.5 0 1 1 .91.417 5 5 0 1 0 9.375.789z"></path>
                            <path fill-rule="evenodd" d="M7.854.146a.5.5 0 0 0-.708 0l-2.5 2.5a.5.5 0 0 0 0 .708l2.5 2.5a.5.5 0 1 0 .708-.708L5.707 3 7.854.854a.5.5 0 0 0 0-.708z"></path>
                        </svg>
                    </div>
                    <h3>Simple Returns</h3>
                    <p>Far far away, behind the word mountains, far from the countries.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest Products -->
<div class="container">
    <div class="section-title">
        <h2>
            <h2>LATEST PRODUCTS</h2>
        </h2>
    </div>
</div>
<section class="slider">
    <ul id="autoWidth" class="cs-hidden">
        @foreach ($products as $product )
        <li class="item-a">
            <div class="box">
                <div class="slide-img">
                    <img alt="{{ $product->name }}" src="{{ asset('Images-Product/'.$product->main_image) }}">
                    @if($timerSales)
                        @if($product->sales && $timerSales->status && $timerSales->sale_date > Carbon\Carbon::now())
                            <span id="sales" class="badge badge-pill badge-warning">sales</span>
                        @endif
                    @endif
                    @if((Carbon\Carbon::parse($product->published_at)->diffInDays() - Carbon\Carbon::parse(now())->diffInDays()) <=7)
                         <span id="new" class="badge badge-pill badge-success">New</span>
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

<!--  Product filter section  -->
<section class="product-filter-section">
    <div class="container">
        <div class="section-title">
            <h2>BROWSE TOP SELLING PRODUCTS</h2>
        </div>
        <ul class="product-filter-menu">
            @foreach ($categories as $category )
                <li><a href="{{ route('category',[$category->id,$category->name]) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
        <div class="row">
            @foreach ($randomProducts as $product )
                <div class="col-lg-3 col-sm-6">
                    <div class="box">
                        <div class="slide-img">
                            <img alt="{{ $product->name }}" src="{{ asset('images-product/'.$product->main_image) }}">
                            @if($timerSales)
                                @if($product->sales && $timerSales->status && $timerSales->sale_date > Carbon\Carbon::now())
                                    <span id="sales" class="badge badge-pill badge-warning">sales</span>
                                @endif
                            @endif
                            @if((Carbon\Carbon::parse($product->published_at)->diffInDays() - Carbon\Carbon::parse(now())->diffInDays()) <=7)
                                 <span id="new" class="badge badge-pill badge-success">New</span>
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
                                                <span style="position: absolute;left:240px;">${{ $product->price }}</span>
                                            @endif
                                        @else
                                            <span style="position: absolute;left:240px;">${{ $product->price }}</span>
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
                </div>
            @endforeach
        </div>
        <div class="text-center pt-5">
            <a href="{{ route('products.index') }}"><button class="site-btn sb-line sb-dark">LOAD MORE</button></a>
        </div>
    </div>
</section>

<!-- testimonials section -->
<div class="container">
    <div class="section-title">
        <h2>
            <h2>Our Customers and Testimonials</h2>
        </h2>
    </div>
</div>
<div class="testimonials">
    <div class="container">
        <ul id="autoWidth2" class="cs-hidden2">
            @foreach($testimonials as $testimonial)
            <li class="item-a">
                <div class="single-box">
                    <div class="img-area">
                        <img src="{{ asset('testimonial-image/'.$testimonial->image) }}" alt="">
                    </div>
                    <div class="img-text">
                        <h2>{{ $testimonial->customer_name }}</h2>
                        <p>
                            {!! Str::limit($testimonial->description, 150,'...') !!}
                        </p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>


<!-- Latest Blog -->
<div class="container">
    <div class="section-title">
        <h2>
            <h2>Recent Posts</h2>
        </h2>
    </div>
</div>
<div class="latest-blog">
    <ul id="autoWidth3" class="cs-hidden3">
        @foreach ($posts as $post)
        <li class="item-a">
            <div class="single-blog">
                <div class="blog-img">
                    <img src="{{ asset('post-image/'.$post->image) }}" alt="">
                </div>
                <div class="blog-text">
                    <h2>{{ Str::limit($post->title,20, '') }}</h2>
                    <span class="mb-3 d-block post-date mt-3">{{ $post->created_at->format('Y-m-d') }} <a href="#">&nbsp;{{ $post->user->name }}</a></span>
                    <p>
                        {!! Str::limit($post->body, 200, '...') !!}
                    </p>
                    <a href="{{ route('singlePost',[$post->id,$post->slug]) }}" class="btn btn-sm animated-button victoria-one">Read More</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection

<!-- scripts -->
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

    $(document).ready(function() {
        $('#autoWidth2').lightSlider({
            autoWidth: true
            , loop: true
            , onSliderLoad: function() {
                $('#autoWidth2').removeClass('cS-hidden2');
            }
        });
    });

    $(document).ready(function() {
        $('#autoWidth3').lightSlider({
            autoWidth: true
            , loop: true
            , onSliderLoad: function() {
                $('#autoWidth3').removeClass('cS-hidden3');
            }
        });
    });

    $('.carousel').carousel({
        interval: 2000
    })

</script>
@endsection
