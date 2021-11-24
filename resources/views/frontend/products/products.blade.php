@extends('frontend.layouts.master')



@section('head')
<title>Shop and Category</title>
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
<script src="{{ asset('js/fiterByPrice.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-3">
            @include('error.index')
            <h2>Shop and Category</h2>
        </div>
        <div class="col-md-9">
            <search-product-component></search-product-component>
        </div>
    </div>
</div>
<section class="content mt-5">
    <div class="container">
        <div class="row">
            @include('frontend.products.partial.filtersection')
            <div class="col-md-9">
                <div class="row">
                    @foreach ($products as $key => $product )
                        <div class="col-md-4" role-id="{{ $key }}">
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
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">{{$products->links('vendor.pagination.bootstrap-4')}}</div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection



@section('scripts')

@endsection
