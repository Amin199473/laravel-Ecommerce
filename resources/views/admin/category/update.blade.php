@extends('admin.layouts.master')




@section('head')
<title>Categories</title>
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
                        <h1><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Categories</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('category.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Category List</button>
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
                    <h3 class="card-title">Add category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('category.update',$category->id) }}" id="category" method="POST">
                    @csrf
                    @method('Put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name Category</label>
                            <input class="form-control" value="{{ $category->name }}" name="name" id="name" placeholder="Enter Category">
                        </div>
                        <div class="form-group">
                            <label for="parent_id"> parent Category </label>
                            <select name="parent_id" id="parent" class="form-control">
                                <option value="">None parent Category</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : ''  }}>
                                    {{ $cat->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parent_id"> Related Category To Product/Post </label>
                            <select name="model_type" id="related_model" class="form-control">
                                <option value="">Select Related Category</option>
                                <option value="App\Models\Post" {{ $category->model_type =='App\Models\Post'? 'selected':'' }}>Post</option>
                                <option value="App\Models\Product" {{ $category->model_type =='App\Models\Product'? 'selected':'' }}>Product</option>
                            </select>
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
        $("#category").validate({
            rules: {
                name:{
                    required: true,
                    minlength:3,
                },
                related_model:'required',
            },
            messages:{
                name:'The title field must be at least 3 characters and required.',
                related_model:'please select Related model.'
            }
        });
    });

    let alert = document.querySelector('.alert');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 8000);
    }

</script>
@endsection
