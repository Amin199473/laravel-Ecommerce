@extends('admin.layouts.master')




@section('head')
<title>testimonial</title>
<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
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
                    <div class="col-ms-6 ml-2">
                        <h1><i class="fa fa-text-height" aria-hidden="true"></i> &nbsp; testimonial</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('testimonials.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To testimonial List</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">testimonial</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    @include('error.index')
    <form action="{{ route('testimonials.update', $testimonial->id) }}" id="testimonial" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add testimonial</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Customer Name</label>
                            <input class="form-control" value="{{ $testimonial->customer_name }}" id="customer_name" name="customer_name" placeholder="Enter Customer Name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editor1" name="description" class="form-control" rows="3" placeholder="Enter description" style="margin-top: 0px; margin-bottom: 0px; height: 750px;">{{ $testimonial->description }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <!-- Form Element sizes -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">testimonial Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <img src="{{ asset('testimonial-image/'.$testimonial->image) }}" alt="" width="100%">
                            <input type="file" id="image" name="image" required="required" class="form-control">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">Save testimonial</button>
            </div>
        </div>
    </form>
</section>
@endsection


@section('script')
<script>
      // jQuery Validation Form slider
      $(document).ready(function() {
        $("#testimonial").validate({
            rules: {
                customer_name:{
                    required: true,
                    minlength:3,
                },
                image:{
                    required: true,

                },
            },
            messages:{
                customer_name:'The title field must be at least 3 characters and required.',
                image:'The Image must be jpeg,jpg,png and max size 2MB required.',
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

    // interact CKEditor with laravel-fileManager
    CKEDITOR.replace('editor1', {
        filebrowserImageBrowseUrl: '/admin/file-manager/'
    });

</script>
@endsection
