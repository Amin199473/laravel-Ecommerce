@extends('admin.layouts.master')

@section('head')

@endsection


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-4 ml-2">
                        <h1><i class="fa fa-product-hunt" aria-hidden="true"></i>&nbsp; Prodcut</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Prodcut</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header text-center">
            {{ $product->name }}
        </div>
        <div class="card-body">
            <p class="card-text">
                <p class="text-center">{{ $product->title }}</p>
                <p class="text-center">
                    <img src="{{ asset('Images-Product/'.$product->main_image) }}" alt="{{ $product->name }}" class="card-img rounded-0">
                </p>
                <p class="card-text">
                    <h5>
                        {!! $product->descriptions !!}
                    </h5>
                </p>
            </p>
        </div>
        <div class="card-footer text-muted text-center">
            <span class="mr-4">{{ $product->created_at->diffForHumans() }}</span>
            <span>Created by:{{ $product->user->name }}</span>
        </div>
    </div>
</section>
@endsection



@section('scripts')

@endsection
