@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
    <i class="fa fa-check" aria-hidden="true"></i>
</div>
@endif

@if(session('failed'))
<div class="alert alert-light">
    {{ session('failed') }}
    <i class="fa fa-check" aria-hidden="true"></i>
</div>
@endif
