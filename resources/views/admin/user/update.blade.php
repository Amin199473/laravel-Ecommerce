@extends('admin.layouts.master')




@section('head')
<title>Edit User</title>
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
                        <h1><i class="fa fa-users" aria-hidden="true"></i>&nbsp; User</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('user.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To User List</button>
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
    <form action="{{ route('user.update',$user->id) }}" method="POST" id="user" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" value="{{ $user->name}}" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date Of Birth</label>
                            <input type="date" class="form-control" value="{{ $user->profile->dateOfBirth }}" id="dateOfBirth" name="dateOfBirth" placeholder="Enter Date of Birth">
                        </div>
                        <div class="form-group" style="margin-top: 30px">
                            <label for="gender">Gender</label>
                            <input type="radio" name="gender" id="male" value="male"  class="ml-2" {{ $user->profile->gender =='male'?'checked':'' }}>Male
                            <input type="radio" name="gender" id="female" value="female" class="ml-2" {{ $user->profile->gender =='female'?'checked':'' }}>Female
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" placeholder="Enter password">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <!-- Form Element sizes -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Role and permission</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Roles</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">-select Role-</option>
                                @foreach ($roles as $role )
                                @if(!\Auth::user()->hasRole('super-admin') && $role->name=='super-admin') @continue; @endif
                                <option value="{{ $role->name }}" @foreach($user->getRoleNames() as $rol ){{ $role->name == $rol? 'selected':'' }}@endforeach>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            @role('super-admin')
                            <div class="form-group">
                                <label for="">Permissions</label>
                                @foreach ($permissions as $key=>$permission)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="{{ 'customCheckbox'.++$key }}" value="{{ $permission->name }}" name="permissions[]" @foreach ($user->getPermissionsViaRoles() as $per )
                                    {{ $permission->name == $per->name? 'checked':'' }}
                                    @endforeach>
                                    <label for="{{ 'customCheckbox'.((++$key)-1) }}" class="custom-control-label">{{ $permission->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            @endrole
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
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
<script>

     //jQuery Validation form
     $(document).ready(function() {
        $("#user").validate({
            rules: {
                name:{
                    required: true,
                    minlength:3,
                },
                dateOfBirth:{
                    required:true,
                },
                email:{
                    required: true,
                    email:true,
                },
                gender:{
                    required: true
                },
                role:{
                    required:true,
                },
            },
            messages:{
                name:'The feild name must be at least 3 characters and required.',
                email:'The email field must be unique and email formt.',
                dateOfBirth:'selet date of birth.',
                gender:'please select gender',
                role:'please select role',
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
