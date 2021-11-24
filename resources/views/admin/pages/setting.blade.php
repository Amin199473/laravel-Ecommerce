@extends('admin.layouts.master')



@section('head')
<title>Setting</title>
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }

</style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-4 ml-2">
                        <h1><i class="fa fa-cog" aria-hidden="true"></i>&nbsp; Setting</h1>
                    </div>
                    <div class="col-ms-4 ml-2">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    @include('error.index')
    <form action="{{ route('setting.store') }}" method="POST" id="setting" enctype="multipart/form-data">
        @csrf
        @method('Post')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Setting Site</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="site_title">Site Title</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->site_title:'' }}" id="site_title" name="site_title" placeholder="Enter Site Title">
                        </div>
                        <div class="form-group">
                            <label for="site_description">Site Description</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->site_description:'' }}" id="site_description" name="site_description" placeholder="Enter Site Description">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="{{ $setting? $setting->email:'' }}" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->phone:'' }}" id="phone" name="phone" placeholder="Enter Site phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->address:'' }}" id="address" name="address" placeholder="Enter Site Address">
                        </div>
                        <div class="form-group">
                            <label for="copy_right">Content Copy Right</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->copy_right:'' }}" id="copy_right" name="copy_right" placeholder="Enter Copy Right">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <!-- Form Element sizes -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Social Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="whatsapp">WhatsApp</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->whatsapp:'' }}" id="whatsapp" name="whatsapp" placeholder="Enter whatsapp Link">
                        </div>
                        <div class="form-group">
                            <label for="youTube">You Tube</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->youTube:'' }}" id="youTube" name="youTube" placeholder="Enter youTube Link">
                        </div>
                        <div class="form-group">
                            <label for="tweeter">Tweeter</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->tweeter:'' }}" id="tweeter" name="tweeter" placeholder="Enter Tweeter Link">
                        </div>
                        <div class="form-group">
                            <label for="telegram">Telegram</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->telegram:'' }}" id="telegram" name="telegram" placeholder="Enter Telegram Link">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" value="{{ $setting? $setting->instagram:'' }}" id="instagram" name="instagram" placeholder="Enter Instram link">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">save Changes</button>
            </div>
        </div>
    </form>
</section>
@endsection

@section('script')
<script>

     // jQuery Validation Form slider
     $(document).ready(function() {
        $("#setting").validate({
            rules: {
                site_title:{
                    required: true,
                    minlength:3,
                },
                site_description:{
                    required: true,
                    minlength:3,
                },
                email:{
                    required: true,
                    email:true
                },
                address:{
                    required:true,
                },
                phone:{
                    required:true,
                },
                copy_right:{
                    required:true,
                },
            },
            messages:{
                site_title:'the title site must be at least 3 characters.',
                site_description:'the site description site must be at least 3 characters',
                email:'the phone number is required',
                address:'the address is required',
                phone:'the phone is required',
                copy_right:'the copy right is required',
            }
        });
    });

    //remove Alert box
    let alert = document.querySelector('.alert');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 8000);
    }
</script>
@endsection
