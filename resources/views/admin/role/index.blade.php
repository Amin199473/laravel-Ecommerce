@extends('admin.layouts.master')



@section('head')
<title>Roles</title>
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-6 ml-2">
                        <h1><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; Roles and Permissions</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('role.create') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Add New Role</button>
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
    <div class="container-fluid">
        @include('error.index')
        <div class="row">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">List All Roles </h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Number</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Permission</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">tools</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($role_permissions as $key=>$role )
                                            <tr {{ $key/2 === 0 ? 'class="even"':'class="odd"' }}>
                                                <td class="dtr-control sorting_1" tabindex="0">{{ ++$key }}</td>
                                                <td><span class="badge badge-dark">{{ $role->name}}</span></td>
                                                <td>
                                                    @foreach ($role->permissions as $per )
                                                    <span class='badge badge-dark'>{{ $per->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    {{-- <input type="checkbox" id="featured" {{$post->featured ? 'checked=checked' : '' }}> --}}
                                                    <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <a href="{{ route('role.edit' ,$role->id) }}"><i class="fa fa-pencil" aria-hidden="true" style="color: rgb(119, 0, 255)"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#deleteModal" data-roleid="{{ $role->id }}"><i class="fa fa-trash" style="color: rgb(199, 53, 53)"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    {{-- modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete
                        this?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    select "delete" if you want to delete this Post
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>

                    <form action="" method="POST">
                        @method('DELETE')
                        @csrf
                        {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                        <a href="#" class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script>
    let alert = document.querySelector('.alert');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 3000);
    }
    //script for submit form delete action
    $('#deleteModal').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let role_id = button.data('roleid')

        let modal = $(this)
        //   modal.find('.modal-footer #userId').val(userId)
        modal.find('form').attr('action', 'role/' + role_id)
    });


    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true
            , "lengthChange": false
            , "searching": false
            , "ordering": true
            , "info": true
            , "autoWidth": false
            , "responsive": true
        , });
    });

</script>
@endsection
