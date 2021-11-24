@extends('admin.layouts.master')



@section('head')
<title>About Us</title>
<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
@endsection


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-4 ml-2">
                        <h1><i class="fa fa-users" aria-hidden="true"></i>&nbsp; About Us</h1>
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
    <form action="{{ route('admin.about-us.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data"> @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Page Content</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea id="editor1" name="description" class="form-control" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 750px;">{{ $aboutus?$aboutus->description:'' }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">Save Content</button>
            </div>
        </div>
    </form>
</section>
@endsection




@section('script')
<script>
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
