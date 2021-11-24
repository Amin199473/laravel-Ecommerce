@extends('admin.layouts.master')



@section('head')
<title>Contact</title>
@endsection



@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-4 ml-2">
                        <h1><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Contact</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="card text-center">
        <div class="card-header">
            Name:{{ $contact->name }}
        </div>
        <div class="card-body">
            <p class="card-text">
                <p class="text-center">
                    <h3> {{ $contact->subject }}</h3>
                </p>
                <p class="card-text">
                    <h5>{{ $contact->message }}
                    </h5>
                </p>
            </p>
        </div>
        <div class="card-footer text-muted">
            {{ $contact->created_at->diffForHumans() }}
        </div>
    </div>
</section>
@endsection


@section('script')

@endsection
