@extends('frontend.layouts.master')


@section('head')
<title>Contact Us</title>
{{-- <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}"> --}}
<style>
    /*
** Style Simple Ecommerce Theme for Bootstrap 4
** Created by T-PHP https://t-php.fr/43-theme-ecommerce-bootstrap-4.html
*/
    .bloc_left_price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 150%;
    }

    .category_block li:hover {
        background-color: #007bff;
    }

    .category_block li:hover a {
        color: #ffffff;
    }

    .category_block li a {
        color: #343a40;
    }

    .add_to_cart_block .price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 200%;
        margin-bottom: 0;
    }

    .add_to_cart_block .price_discounted {
        color: #343a40;
        text-align: center;
        text-decoration: line-through;
        font-size: 140%;
    }

    .product_rassurance {
        padding: 10px;
        margin-top: 15px;
        background: #ffffff;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .product_rassurance .list-inline {
        margin-bottom: 0;
        text-transform: uppercase;
        text-align: center;
    }

    .product_rassurance .list-inline li:hover {
        color: #343a40;
    }

    .reviews_product .fa-star {
        color: gold;
    }

    .pagination {
        margin-top: 20px;
    }

    label.error {
       color: #dc3545;
       font-size: 14px;
   }
</style>
@endsection



@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">E-COMMERCE CONTACT</h1>
        <p class="lead text-muted mb-0">Contact Us Page</p>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            @include('error.index')
            <div class="card">
                <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Contact us.
                </div>
                <div class="card-body">
                    <form action="{{ route('contactUs.store') }}" id="contact" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">Number Phone</label>
                            <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="phone" aria-describedby="emailHelp" placeholder="Enter Number Phone">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" value="{{ old('subject') }}" name="subject" id="subject" aria-describedby="emailHelp" placeholder="Enter Subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="6"></textarea>
                        </div>
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary text-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                <div class="card-body">
                    <p>{{ $setting->address }}</p>
                    <p>Email : {{ $setting->email }}</p>
                    <p>Tel. {{ $setting->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    // jQuery Validation Form slider
    $(document).ready(function () {
        $("#contact").validate({
         rules: {
             name: {
                 required: true,
                 minlength: 3,
             },
             email: {
                 required: true,
                 email: true,
             },
             phone: {
                 required: true,
             },
             subject: {
                 required: true,
                 minlength: 3,
             },
             message: {
                 required: true,
                 minlength: 3,
             },
         },
         messages: {
             name: 'The name field must be at least 3 characters and required.',
             email: 'The email field must be be at right format',
             phone: 'The phone field required',
             subject: 'The subject field must be beat least 3 characters and required',
             message: 'The message field must be beat least 3 characters and required',
        }
     });
    });
</script>
@endsection
