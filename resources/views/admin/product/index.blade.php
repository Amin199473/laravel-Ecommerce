@extends('admin.layouts.master')



@section('head')
<title>Products</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
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
                    <div class="col-ms-4 ml-2">
                        <h1><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp; Products</h1>
                    </div>
                    <div class="col-ms-4 ml-2">
                        <a href="{{ route('product.create') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Add New Product</button>
                        </a>
                    </div>
                    <div class="col-ms-4 ml-2">
                        <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#exampleModal">Remove All Products</button>
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
                        <h2 class="card-title">List All Posts</h2>
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
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Image</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Price</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Sales</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Category</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Brand</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Published Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tools</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key=>$product )
                                            <tr {{ $key/2 === 0 ? 'class="even"':'class="odd"' }}>
                                                <td class="dtr-control sorting_1" tabindex="0">{{ ++$key }}</td>
                                                <td>{{ Str::limit($product->name,10, '...') }}</td>
                                                <td>
                                                    <img src="{{ asset('Images-Product/'.$product->main_image) }}" alt="" style="width: 70px">
                                                </td>
                                                <td>{{ $product->sku }}</td>
                                                <td>${{ $product->price }}</td>
                                                <td>${{ $product->sales }}</td>
                                                <td>
                                                    @if($product->status == 'Published')
                                                    <span class="badge badge-success">Published</span>
                                                    @elseif ($product->status == 'Pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                    @else
                                                    <span class="badge badge-danger">Soon</span>
                                                    @endif
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($product->published_at)->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" data-id="{{ $product->id }}" class="featured" {{$product->featured ? 'checked=checked' : '' }}>
                                                    <a href="{{ route('product.show',$product->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <a href="{{ route('product.edit' ,$product->id) }}"><i class="fa fa-pencil" aria-hidden="true" style="color: rgb(119, 0, 255)"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#deleteModal" data-productid="{{ $product->id }}"><i class="fa fa-trash" style="color: rgb(199, 53, 53)"></i></a>
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

    {{-- modal for single delete --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure for delete this Product?
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

<!-- Modal for major delete -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete All Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure for delete All Products?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                <form action="" method="POST">
                    @method('POST')
                    @csrf
                    {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                    <a href="#" class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                </form>
            </div>
        </div>
    </div>
</div>
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
    //script for submit form Major delete action
    $('#exampleModal').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let recipient = button.data('whatever')
        let modal = $(this)
        modal.find('form').attr('action', 'product-deleteAll')
    })

    //script for submit form single delete action
    $('#deleteModal').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let product_id = button.data('productid')

        let modal = $(this)
        //   modal.find('.modal-footer #userId').val(userId)
        modal.find('form').attr('action', 'product/' + product_id)
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

    (function() {
        const featurs = document.querySelectorAll('.featured');
        // console.log(featurs);
        Array.from(featurs).forEach(function(element) {
            element.addEventListener('change', () => {
                const id = element.getAttribute('data-id');
                if (element.checked) {
                    var featured = 1;
                    axios.put(`/admin/featured/${id}`, {
                            featured: 1
                        })
                        .then(function(response) {
                            window.location.href = 'https://laravelshopping.ir/admin/product';
                        })
                        .catch(function(error) {
                            window.location.href = 'https://laravelshopping.ir/admin/product';
                        });
                } else {
                    var featured = 0;
                    axios.put(`/admin/featured/${id}`, {
                            featured: 0
                        })
                        .then(function(response) {
                            window.location.href = 'https://laravelshopping.ir/admin/product';
                        })
                        .catch(function(error) {
                            window.location.href = 'https://laravelshopping.ir/admin/product';
                        });
                }
            })
        })
    })();

</script>
@endsection
