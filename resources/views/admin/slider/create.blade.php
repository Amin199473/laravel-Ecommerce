@extends('admin.layouts.master')




@section('head')
<title>Slider</title>
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }

</style>
<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
@endsection


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-6 ml-2">
                        <h1><i class="fa fa-sliders" aria-hidden="true"></i> &nbsp; Slider</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('slider.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Slider List</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Slider</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    @include('error.index')
    <form action="{{ route('slider.store') }}" method="POST" id="slider" class="form-horizontal" enctype="multipart/form-data"> @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Slider</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title Slider</label>
                            <input class="form-control" id="title" value="{{ old('title') }}" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label>Subtitle slider</label>
                            <textarea id="editor1" name="subtitle" class="form-control" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 750px;">{{ old('subtitle') }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <!-- Form Element sizes -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Slider Details </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="link">URL & Link</label>
                            <input type="text" id="link" name="link" class="form-control" placeholder="like https://www.google.com">
                        </div>
                        <div class="form-group">
                            <label for="button">Content Button</label>
                            <input type="text" id="button" value="{{ old('button') }}" name="button" class="form-control" placeholder="Content Button">
                        </div>
                        <div class="form-group">
                            <label>Status Slider</label>
                            <select id="status" class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Slider Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">create Slider</button>
            </div>
        </div>
    </form>
</section>
@endsection


@section('script')
<script>
    // jQuery Validation Form slider
    $(document).ready(function() {
        $("#slider").validate({
            rules: {
                title:{
                    required: true,
                    minlength:8,
                },
                link:{
                    required: true,
                    url: true
                },
                button:{
                    required: true,
                    minlength:3,
                },
                image:'required',
            },
            messages:{
                title:'The title field must be at least 8 characters and required.',
                link:'The Link field must be URL required.',
                button:'The content of button must be 3 at least characters required.',
                image:'The Image must be jpeg,jpg,png and size 2mb required.',
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
