@extends('admin.layouts.master')




@section('head')
<title>Edit Role</title>
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
                        <h1><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Edit Role</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('role.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Role List</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Role</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    @include('error.index')
    <form action="{{ route('role.update',$role->id ) }}" method="POST" id="role" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Adding Role</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="{{ $role->name }}" placeholder="Enter Role">
                </div>
                <div class="form-group">
                    <label for="permissions">List Permissions by Role</label>
                    <input type="text" data-role="tagsinput" id="permissions" name="permissions" class="form-control" value="@foreach($role_permissions->permissions as $permission ){{ $permission->name."," }}@endforeach">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
</section>
@endsection


@section('script')
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
<script>
        // jQuery Validation Form slider
    $(document).ready(function() {
        $("#role").validate({
            rules: {
                role:{
                    required: true,
                    minlength:3,
                },
                permissions:{
                    required: true,
                    minlength:3,
                }
            },
            messages:{
                role:'The role field must be at least 3 characters and required.',
                permissions:'The permissions field must beat least 3 characters and required',
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
