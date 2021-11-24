@extends('admin.layouts.master')




@section('head')
<title>Create Coupons</title>
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }

</style>
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-ms-6 ml-2">
                        <h1><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp; Coupons</h1>
                    </div>
                    <div class="col-ms-6 ml-2">
                        <a href="{{ route('coupon.index') }}">
                            <button type="button" class="btn btn-block btn-outline-info">Back To Coupon List</button>
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
                    <h3 class="card-title">Add Coupon</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('coupon.store') }}" method="POST" id="coupon">
                    @csrf
                    @method('Post')
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="" name="code" value="{{ old('code') }}" id="code" placeholder="Enter Code">
                            </div>
                            <div class="form-group">
                                <label>Select type of Coupon</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="fixed">fixed</option>
                                    <option value="percent">percent</option>
                                </select>
                            </div>
                            <div id="fixed" class="form-group">

                            </div>
                            <div id="percent" class="form-group">

                            </div>
                            <div class="form-group">
                                <label>Expiry Date:</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="text" value="{{ Carbon\Carbon::now() }}" name="expiry_date" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
<script>
    // jQuery Validation Form slider
    $(document).ready(function() {
        $("#coupon").validate({
            rules: {
                code:{
                    required: true,
                    minlength:3,
                },
                value:{
                    required: true,
                    digits:true
                },
                percent_off:{
                    required:true,
                    digits:true
                },
            },
            messages:{
                code:'The code field must be at least 3 characters and required.',
                value:'The value field must one  number of value and integer',
                percent_off:'The percent off field must one  number of percent and integer',
            }
        });
    });


    (function() {
        let type = document.getElementById('type')
        type.addEventListener('change', () => {
            if (type.value == 'fixed') {
                var percent_off = document.getElementById('percent_off');
                if (percent_off) {
                    percent_off.remove();
                }
                let fixed = document.getElementById('fixed');
                var text1 = document.createElement('div');
                text1.setAttribute("id", "fix");
                text1.innerHTML =
                    "<label for='value'>value</label>" +
                    "<input type='text' class='form-control' value='{{ old('value') }}' id='value' name='value' placeholder='Value'>";
                fixed.appendChild(text1);
                S_BUTTON_HANDLER_WORKING = false
            } else if (type.value == 'percent') {
                var fix = document.getElementById('fix');
                if (fix) {
                    fix.remove();
                }
                let fixed = document.getElementById('percent');
                var text2 = document.createElement('div');
                text2.setAttribute("id", "percent_off");
                text2.innerHTML =
                    "<label for='percent_off'>percent off</label>" +
                    "<input type='text' class='form-control' value='{{ old('percent_off') }}' id='percent_off' name='percent_off' placeholder='percent off'>";
                fixed.appendChild(text2);
            } else {
                return true;
            }
        })
    })();
    let alert = document.querySelector('.alert');
    if (alert) {
        setInterval(() => {
            alert.remove();
        }, 5000);
    }

</script>

@endsection
