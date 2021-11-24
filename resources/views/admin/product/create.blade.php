@extends('admin.layouts.master')




@section('head')
<title>Add Product</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
                        <h1><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp; Prodcut</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('product.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Products List</button>
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
    <form action="{{ route('product.store') }}" method="Post" id="product" enctype="multipart/form-data">
        @csrf
        @method('Post')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="min-height: 1000px">
                        <div class="form-group">
                            <label for="name">Name Product</label>
                            <input class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Enter Name Product">
                        </div>
                        <div class="form-group">
                            <label for="title">Title Product</label>
                            <input class="form-control" value="{{ old('title') }}" id="title" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" value="{{ old('slug') }}" id="slug" name="slug" class="form-control" placeholder="URL Slug">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editor1" name="descriptions" class="form-control" rows="3" placeholder="Enter descriptions" style="margin-top: 0px; margin-bottom: 0px; height: 750px;">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <!-- Form Element sizes -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Status and Categrory Product</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Status Product</label>
                            <select class="form-control" name="status">
                                <option value="Published">Published</option>
                                <option value="Pending">Pending</option>
                                <option value="Soon">Soon</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" id="category" name="category_id">
                                <option value="">-select Category-</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Brand Product</label>
                            <select class="form-control" id="brand" name="brand_id">
                                <option value="">-select Brand-</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group"></div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" id="status" name="featured" checked>
                            <label class="form-check-label">featured</label>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Product Images</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="file" id="image" name="image[]"  class="form-control" multiple>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- general form elements disabled -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Details Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Summary</label>
                            <textarea name="summary" class="form-control" rows="3" id="summary" placeholder="Enter summary" style="margin-top: 0px; margin-bottom: 0px; height: 78px;">{{ old('summary') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="sku">Stock Keep Unit</label>
                            <input type="number" value="{{ old('sku') }}" name="sku" class="form-control" id="sku" placeholder="stock keep Unit">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" value="{{ old('price') }}" name="price" class="form-control" id="price" placeholder="price">
                        </div>
                        <div class="form-group">
                            <label for="sales">Sales</label>
                            <input type="number" value="{{ old('sales') }}" name="sales" class="form-control"  placeholder="on sales price">
                        </div>
                        <div class="form-group">
                            <label>Published Date:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" value="{{ Carbon\Carbon::now() }}" name="published_at" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">create Product</button>
            </div>
        </div>
    </form>
</section>
@endsection


@section('script')
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/date.js') }}"></script>

<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script>
     //jQuery Validation form
     $(document).ready(function() {
        $("#product").validate({
            rules: {
                name:{
                    required: true,
                    minlength:3,
                },
                title:{
                    required: true,
                    minlength:8,
                },
                slug:{
                    required: true,
                    minlength:8,
                },
                image:{
                    required:true
                },
                category_id:{
                    required:true
                },
                brand_id:{
                    required:true
                },
                summary:{
                    required:true,
                    minlength:8,
                },
                sku:{
                    required:true,
                    number:true,
                },
                price:{
                    required:true,
                    number:true,
                },
            },
            messages:{
                name:'The name field must be at least 3 characters and required.',
                title:'The title must be at least 5 characters and required.',
                slug:'The slug must be at least 3 characters required.',
                category_id:'select one category',
                brand_id:'select one brand',
                image:'The Image must be jpeg,jpg,png and size 1MB required.',
                summary:'please fill the one summary from product',
                sku:'The sku field must be number and required.',
                price:'The price field must be decimal and required.',
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

    document.querySelector('#title').addEventListener('keyup', (e) => {
        let title = document.getElementById('title').value;
        let slug = document.getElementById('slug');
        title = title.replace(/\W+(?!$)/g, '-').toLowerCase(); // replace stapces with dash
        // console.log(title);
        slug.setAttribute('value', title)
        // console.log(slug);
    })

    // interact CKEditor with laravel-fileManager
    CKEDITOR.replace('editor1', {
        filebrowserImageBrowseUrl: '/admin/file-manager/'
    });

</script>
@endsection
