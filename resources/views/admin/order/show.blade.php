@extends('admin.layouts.master')



@section('head')
<title> Order Items</title>
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-4 ml-2">
                        <h1><i class="fa fa-cutlery" aria-hidden="true"></i>&nbsp; Order Items:<span class="badge badge-success">{{ $order_items->count() }}</span></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Order Items</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="card">
        <div class="card-header text-center">
            Customer:&nbsp; {{ $order->full_name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex flex-column">
                        <div class="p-2"><span class="badge badge-warning">Email:</span>&nbsp;{{ $order->email }}</div>
                        <div class="p-2"><span class="badge badge-warning">Mobile:</span>&nbsp;{{ $order->mobile }}</div>
                        <div class="p-2"><span class="badge badge-warning">Address 1:</span>&nbsp;{{ $order->address_line1 }}</div>
                        <div class="p-2"><span class="badge badge-warning">Address 2:</span>&nbsp;{{ $order->address_line2 }}</div>
                        <div class="p-2"><span class="badge badge-warning">City:</span>&nbsp;{{ $order->city }}</div>
                        <div class="p-2"><span class="badge badge-warning">Province:</span>&nbsp;{{ $order->province }}</div>
                        <div class="p-2"><span class="badge badge-warning">Country:</span>&nbsp;{{ $order->country }}</div>
                        <div class="p-2"><span class="badge badge-warning">Zip-Code:</span>&nbsp;{{ $order->zipcode }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column">
                        <div class="p-2"><span class="badge badge-warning">Subtotal:</span>&nbsp;${{ $order->subtotal }}</div>
                        <div class="p-2"><span class="badge badge-warning">Discount:</span>&nbsp;{{ $order->discount == 0.00 ? 0.00 : '-'.$order->discount }}</div>
                        <div class="p-2"><span class="badge badge-warning">Tax:</span>&nbsp;${{ $order->tax }}</div>
                        <div class="p-2"><span class="badge badge-warning">Total:</span>&nbsp;${{ $order->total }}</div>
                        <div class="p-2"><span class="badge badge-warning">Order Starus:</span>&nbsp;
                            {{ $order->status }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            {{ $order->created_at->diffForHumans() }}
        </div>
    </div>
    @foreach ($order_items as $item )
    <div class="card text-center">
        <div class="card-header">
            {{ $item->product->name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('Images-Product/'.$item->product->main_image) }}" class="rounded" width="40px">
                </div>
                <div class="col-md-3">
                    <h6>Quantity</h6>
                    <span class="badge badge-info">{{ $item->quantity }}</span>
                </div>
                <div class="col-md-3">
                    <h6>Price</h6>
                    <span class="badge badge-warning">${{ $item->price }}</span>
                </div>
                <div class="col-md-3">
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
            </div>
        </div>
        <div class="card-footer text-muted">
            {{ $item->created_at->diffForHumans() }}
        </div>
        <input type="hidden" name="" class="options" value="{{ $item->options }}">
    </div>
    @endforeach


</section>
@endsection


@section('script')
<script>
</script>
@endsection
