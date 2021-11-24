@extends('frontend.layouts.master')



@section('head')
<title>My Profile</title>
<link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
<style>
    #hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 5px solid rgba(227, 9, 235, 0.1);
    }

    label.error {
        color: #dc3545;
        font-size: 14px;
    }

</style>
@endsection


@section('content')
<div class="container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('error.index')
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if(!$user->profile->avatar && $user->profile->gender =="male" )
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('backend/dist/img/avatar5.png') }}" alt="User profile picture">
                                @elseif(!$user->profile->avatar && $user->profile->gender =="female")
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('backend/dist/img/avatar3.png') }}" alt="User profile picture">
                                @else
                                <img class="profile-user-img img-fluid img-circle " src="{{ asset('avatar-image/'.$user->profile->avatar) }}" alt="User profile picture">
                                @endif
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->profile->job }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Orders</b> <a class="float-right">{{ $orders->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Membership Date</b> <a class="float-right">{{ $user->created_at->format('d M Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Wishlist</b> <a class="float-right">{{ $mywishlists->count() }}</a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block"><b>Info</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Bio</strong>
                            <p class="text-muted">
                                {{ $user->profile->bio }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">{{ $user->profile->address }}</p>
                            <p class="text-muted">{{ $user->profile->city }}</p>
                            <p class="text-muted">{{ $user->profile->province }}</p>
                            <p class="text-muted">{{ $user->profile->country }}</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <p class="text-muted">
                                {{$user->profile->skill}}
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Experince</strong>

                            <p class="text-muted">{{ $user->profile->experince }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">My Orders</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Update Address</a></li>
                                <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">Update Profile</a></li>
                                <li class="nav-item"><a class="nav-link " href="#wishlist" data-toggle="tab">My wishlist</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane  active" id="activity">
                                    @foreach ($orders as $key=>$order )
                                    <div class="card text-center" style="margin-bottom: 100px">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <h4>Order &nbsp;{{++$key }}</h4>
                                                </div>
                                                <div class="col-md-4">
                                                    <form action="{{ route('updateOrderStatus',$order->id) }}" method="POST">
                                                        @csrf
                                                        @method("POST")
                                                        <input type="hidden" name="status" value="canceled">
                                                        @if($order->status == 'ordered')
                                                        <button type="submit" class="btn btn-warning">cancel order</button>
                                                        @endif
                                                    </form>
                                                    <form action="{{ route('updateOrderStatus',$order->id) }}" method="POST">
                                                        @csrf
                                                        @method("POST")
                                                        <input type="hidden" name="status" value="delivered">
                                                        @if($order->status == 'ordered')
                                                        <button type="submit" class="btn btn-success mt-3">deliver order</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($order->orderItems as $item )
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a href="{{ route('product.singleShow',[$item->product->id,$item->product->slug]) }}">
                                                        <img src="{{ asset('Images-Product/'.$item->product->main_image) }}" class="rounded" width="40px">
                                                    </a>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6>Quantity</h6>
                                                    <span class="badge badge-info">{{ $item->quantity }}</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6>Price</h6>
                                                    <span class="badge badge-warning">${{ $item->price }}</span>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6>Options</h6>
                                                    <div class="d-flex flex-column">
                                                        <div class="p-2">
                                                            Color:&nbsp;<span class="badge badge-success">{{unserialize($item->options)->color }}<span />
                                                        </div>
                                                        <div class="p-2">
                                                            Size:&nbsp;<span class="badge badge-success">{{ unserialize($item->options)->size }}<span />
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($order->status =='delivered' && $item->review_status==false)
                                                <div class="col-md-3">
                                                    <a href="{{ route('product.singleShow',[$item->product->id,$item->product->slug]) }}">Write Review</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr id="hr">
                                        @endforeach
                                        <div class="card-body">
                                            <h5 class="text-center mb-5">Order Details</h5>
                                            <div class="row">
                                                <div class="col-md-3"><span class="badge badge-warning">Subtotal:</span>&nbsp;${{ $order->subtotal }}</div>
                                                <div class="col-md-3"><span class="badge badge-warning">Discount:</span>&nbsp;{{ $order->discount == 0.00 ? 0.00 : '-'.$order->discount }}</div>
                                                <div class="col-md-3"><span class="badge badge-warning">Tax:</span>&nbsp;${{ $order->tax }}</div>
                                                <div class="col-md-3"><span class="badge badge-warning">Total:</span>&nbsp;${{ $order->total }}</div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <span class="badge badge-warning">
                                                        Order Status:&nbsp;
                                                    </span>{{ $order->status }}
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($order->status=='canceled')
                                                    <h6>Cancel Date:&nbsp;{{ $order->canceled_date }}</h6>
                                                    @elseif ($order->status=='delivered')
                                                    <h6>Deliver Date:&nbsp;{{ $order->delivered_date }}</h6>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <h5>Date Order:&nbsp;{{ $order->created_at->format('Y-m-d h:m:s') }}</h5>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <form action="{{ route('updateAddressProfile',$user->id) }}" id="updateAddress" method="POST" class="form-horizontal">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="address" value="{{ $user->profile->address }}" id="address" placeholder="address">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="city" value="{{ $user->profile->city }}" id="city" placeholder="city">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="province" class="col-sm-2 col-form-label">Province</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="province" value="{{ $user->profile->province }}" id="province" placeholder="Province">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="province" class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="country" value="{{ $user->profile->country }}" id="country" placeholder="country">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form action="{{ route('updateProfile',$user->id) }}" method="POST" id="profile" class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="job" class="col-sm-2 col-form-label">My Job</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ $user->profile->job }}" name="job" id="job" placeholder="My Job">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-2 col-form-label">Password Confirmation</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                @if(!$user->profile->avatar && $user->profile->gender =="male" )
                                                <img class="profile-user-img img-fluid img-circle mb-2" src="{{ asset('backend/dist/img/avatar5.png') }}" alt="User profile picture">
                                                @elseif(!$user->profile->avatar && $user->profile->gender =="female")
                                                <img class="profile-user-img img-fluid img-circle " src="{{ asset('backend/dist/img/avatar3.png') }}" alt="User profile picture">
                                                @else
                                                <img class="profile-user-img img-fluid img-circle " src="{{ asset('avatar-image/'.$user->profile->avatar) }}" alt="User profile picture">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="avatar" class="col-sm-2 col-form-label">Upload Avatar</label>
                                            <div class="col-sm-10 mb-3">
                                                <input type="file" class="form-control" name="avatar" id="avatar">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="experince" class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="experince" id="experince" placeholder="experince">{{ $user->profile->experince }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bio" class="col-sm-2 col-form-label">Bio</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="bio" id="bio" placeholder="bio">{{ $user->profile->bio }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="skill" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{ $user->profile->skill }}" class="form-control" name="skill" id="skill" placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" checked readonly> I agree to the <a href="{{ route('privacyPolicy') }}">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="wishlist">
                                    <div class="row">
                                        @foreach ($mywishlists as $wishlist)
                                        <div class="col-md-4">
                                            <a href="{{ route('product.singleShow',[$wishlist->product->id,$wishlist->product->slug]) }}">
                                                <p>{{ $wishlist->product->name }}</p>
                                                <br>
                                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('Images-Product/'.$wishlist->product->main_image) }}" alt="" class="">
                                            </a>
                                            <form action="{{ route('removeFromWishlist',$wishlist->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="product_id" value="{{ $wishlist->id }}">
                                                <button type="submit" class="btn btn-light">Remove <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('scripts')
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    //jQuery Validation form
    $(document).ready(function() {
        $("#updateAddress").validate({
            rules: {
                address: {
                    required: true
                    , minlength: 3
                , }
                , city: {
                    required: true
                    , minlength: 3
                , }
                , province: {
                    required: true
                    , minlength: 3
                , }
                , country: {
                    required: true
                    , minlength: 3
                , }
            , }
            , messages: {
                adrress: 'The adrress field  must be at least 3 characters'
                , city: 'The city field  must be at least 3 characters'
                , province: 'The province field must be at least 3 characters'
                , country: 'The country field must be at least 3 characters'
            , }
        });
    });

    //jQuery Validation form
    $(document).ready(function() {
        $("#profiles").validate({
            rules: {
                name: {
                    minlength: 3
                , }
                , email: {
                    email: true
                , }
                , password: {
                    pwcheck: true
                    , minlength: 3
                , }
                , password_confirmation: {
                    equalTo: "#password"
                , }
                , experince: {
                    minlength: 3
                , }
                , bio: {
                    minlength: 3
                , }
                , skill: {
                    minlength: 3
                , }
            , }
            , messages: {
                name: 'The field name must be at least 3 characters'
                , email: 'The email field must be unique and email formt.'
                , password: '(strong password)The Password Consis of English uppercase characters (A – Z) and lowercase characters (a – z) and Base 10 digits (0 – 9) and Non-alphanumeric (For example: !, $, #, or %) Unicode characters'
                , password_confirmation: ' Enter Confirm Password Same as Password'
                , experience: 'The experience field must be at least 3 characters.'
                , bio: 'The bio field must be at least 3 characters.'
                , skill: 'The skill field must be at least 3 characters.'
            , }
        });
        $.validator.addMethod("pwcheck"
            , function(value, element) {
                return /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(value);
            });
    });

</script>
@endsection
