@extends('admin.layouts.master')




@section('head')
<title>Add Brand</title>
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
                        <h1><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Brand</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('brand.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Brand List</button>
                        </a>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Brand</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('brand.update',$brand->id) }}" id="brand" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name Brand</label>
                            <input class="form-control" value="{{ $brand->name }}" name="name" id="name" placeholder="Enter Brand">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{ $brand->slug }}" id="slug" name="slug" class="form-control" placeholder="URL Slug">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('script')
<script>

      // jQuery Validation Form slider
      $(document).ready(function() {
        $("#brand").validate({
            rules: {
                name:{
                    required: true,
                    minlength:3,
                },
                slug:{
                    required: true,
                    minlength:3,
                }
            },
            messages:{
                name:'The name field must be at least 3 characters and required.',
                slug:'The slug field must be beat least 3 characters and required',
            }
        });
    });

    let alert = document.querySelector('.alert');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 5000);
    }

    // auto write for slug input
    document.querySelector('#name').addEventListener('keyup', (e) => {
        let title = document.getElementById('name').value;
        let slug = document.getElementById('slug');
        title = title.replace(/\W+(?!$)/g, '-').toLowerCase(); // replace stapces with dash
        // console.log(title);
        slug.setAttribute('value', title)
        // console.log(slug);
    })

</script>
@endsection
