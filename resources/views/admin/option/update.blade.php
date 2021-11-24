@extends('admin.layouts.master')




@section('head')
<title>Edit Option Product</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
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
                        <h1><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;Option</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('option.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Options List</button>
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
                    <h3 class="card-title">Add Options</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('option.update',$option->id) }}" id="options" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="option_name">Option Name</label>
                            <input class="form-control" value="{{ $option->option_name }}" name="option_name" id="option_name" placeholder="Enter Option Name">
                        </div>
                        <div class="form-group">
                            <label for="option_values">option Value</label>
                            <input type="text" value="@foreach(unserialize($option->option_value) as $val ){{ $val.','}}@endforeach" data-role="tagsinput" id="option_values" name="option_values" class="form-control" placeholder="Update Option Value">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Related Product</label>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value=""> -select One Product-</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $option->product_id ==$product->id?'selected':'' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


@section('script')
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script>

       // jQuery Validation Form slider
    $(document).ready(function() {
        $("#options").validate({
            rules: {
                option_name:{
                    required: true,
                    minlength:3,
                },
                option_value:{
                    required: true,
                    minlength:3,
                },
                product_id:{
                    required:true
                }
            },
            messages:{
                option_name:'The option name field must be at least 3 characters and required.',
                option_value:'The option value field must be beat least 3 characters and required',
                product_id:'please selecton one product.',
            }
        });
    });

    let alert = document.querySelector('.alert');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 5000);
    }

</script>
@endsection
