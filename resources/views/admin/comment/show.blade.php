@extends('admin.layouts.master')



@section('head')
<title>Comment </title>
@endsection



@section('content')
<section class="content">
    <div class="card text-center">
        <div class="card-header">
            @if($comment->guest_name==null)
            Name:{{ $comment->commenter->name }}
            @else
            Name:{{ $comment->guest_name }}
            @endif
        </div>
        <div class="card-body">
            <p class="card-text">
                <p class="text-center">
                    <h3> Comment Content</h3>
                </p>
                <p class="card-text">
                    <h5>{{ $comment->comment }}
                    </h5>
                </p>
                <form action="{{ route('approveComment',$comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if($comment->approved ==0)
                    Are You Approved This Comment?
                    <input type="hidden" name="approved" value="1">
                    <button type="submit" class="btn btn-success">YES</button>
                    @else
                    Are You disapproved This Comment?
                    <input type="hidden" name="approved" value="0">
                    <button type="submit" class="btn btn-danger">YES</button>
                    @endif
                </form>
            </p>
        </div>
        <div class="card-footer text-muted">
            {{ $comment->created_at->diffForHumans() }}
        </div>
    </div>
</section>
@endsection


@section('script')

@endsection
