@extends('admin.layouts.master')




@section('head')
<title>Post</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
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
                        <h1><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp; Edit Post</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('post.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Post List</button>
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
    <form action="{{ route('post.update' ,$post->id) }}" method="Post" id="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="min-height: 1000px">
                        <div class="form-group">
                            <label for="title">Title Post</label>
                            <input class="form-control" value="{{ $post->title }}" id="title" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">subtitle</label>
                            <input class="form-control" value="{{ $post->subtitle }}" id="subtitle" name="subtitle" placeholder="Enter subtitle">
                        </div>
                        <div class="form-group">
                            <label>Post Content</label>
                            <textarea id="editor1" name="body" class="form-control" rows="3" placeholder="Enter content" style="margin-top: 0px; margin-bottom: 0px; height: 750px;">{{ $post->body }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <!-- Form Element sizes -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Post Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="slug">URL Slug</label>
                            <input type="text" id="slug" value="{{ $post->slug }}" name="slug" class="form-control" placeholder="URL Slug">
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags Of Post</label>
                            <input type="text" data-role="tagsinput" id="tags" name="tags" class="form-control" value="@foreach($post->tags as $tag){{ $tag->name."," }}@endforeach">
                        </div>
                        <div class="form-group">
                            <label>Status Post</label>
                            <select class="form-control" name="status">
                                <option value="Published" {{ $post->status==='Published'?'selected':'' }}>Published</option>
                                <option value="Draft" {{ $post->status==='Draft'?'selected':'' }}>Draft</option>
                                <option value="Pending" {{ $post->status==='Pending'?'selected':'' }}>Pending</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                <option value="">-select Category-</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category->id == $category->id?'selected':''  }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group"></div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" id="status" name="featured" {{ $post->featured == '1'? 'checked' : '' }}>
                            <label class="form-check-label">featured</label>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Post Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <img src="{{ asset('post-image/'.$post->image) }}" alt="" width="100%">
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- general form elements disabled -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Seo Content</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 78px;">{{ $post->meta_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <textarea name="meta_keywords" class="form-control" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 78px;">{{ $post->meta_keywords }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="seo_title">Seo Title</label>
                            <input type="text" value="{{ $post->seo_title }}" name="seo_title" class="form-control" id="seo_title" placeholder="Seo title">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- general form elements disabled -->

                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
</section>
@endsection


@section('script')
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script>

    //jQuery validation
    $(document).ready(function() {
        $("#post").validate({
            rules: {
                title:{
                    required: true,
                    minlength:5,
                },
                subtitle:{
                    required: true,
                    minlength:5,
                },
                slug:{
                    required: true,
                    minlength:5,
                },
                tags:{
                    required: true,
                    minlength:3,
                },
                category:{
                    required:true
                },
                meta_description:{
                    required:true,
                    minlength:3,
                },
                meta_keywords:{
                    required:true,
                    minlength:3,
                },
                seo_title:{
                    required:true,
                    minlength:3,
                },
            },
            messages:{
                title:'The title field must be at least 5 characters and required.',
                subtitle:'The subtitle must be at least 5 characters and required.',
                slug:'The slug must be 3 at least characters required.',
                tags:'The tags must be 5 at least characters required.',
                category:'select one category',
                meta_description:'The meta description must be at least 3 characters and required.',
                meta_keywords:'The meta keywords must be at least 3 characters and required.',
                seo_title:'The seo title must be at least 3 characters and required.',
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
