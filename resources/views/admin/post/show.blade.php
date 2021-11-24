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
                        <h1><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp; Post</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Post</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header text-center">
            {{ $post->title }}
        </div>
        <div class="card-body">
            <p class="card-text">
                <p class="text-center">
                    <img src="{{ asset('post-image/'.$post->image) }}" alt="{{ $post->title }}" class="card-img rounded-0">
                </p>
                <p class="card-text">
                    <h5>
                        {!! $post->body !!}
                    </h5>
                </p>
            </p>
        </div>
        <div class="card-footer text-muted text-center">
            <span class="mr-4">{{ $post->created_at->diffForHumans() }}</span>
            <span>Author:{{ $post->user->name }}</span>
        </div>
    </div>
</section>
@endsection



@section('scripts')

@endsection
