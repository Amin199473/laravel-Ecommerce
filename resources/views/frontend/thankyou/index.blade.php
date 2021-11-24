@extends('frontend.layouts.master')


@section('head')
<title>Thank You</title>
@endsection

@section('content')
<div class="jumbotron text-center">
    {{-- <div class="text-center">
        @include('error.index')
    </div> --}}
    <h1 class="display-3">Thank You!</h1>
    <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
    <hr>
    <p>
        Having trouble? <a href="{{ route('contactUs') }}">Contact us</a>
    </p>
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{ route('welcome') }}" role="button">Continue to homepage</a>
    </p>
</div>
@endsection

@section('scripts')

@endsection
