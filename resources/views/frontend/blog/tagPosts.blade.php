@extends('frontend.layouts.master')




@section('head')
{{-- <link rel="stylesheet" href="{{ asset('blog/css/style.map') }}"> --}}
<link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
@endsection

@section('content')



<section class="blog_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <h2 class="mb-5">{{ $tag->name }}</h2>
                <div class="blog_left_sidebar">
                    @foreach ($tag->posts as $post)
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="{{ asset('post-image/'.$post->image) }}" alt="">
                            <a href="{{ route('singlePost', [$post->id, $post->slug]) }}" class="blog_item_date">
                                <h3>{{ $post->created_at->format('d') }}</h3>
                                <p>{{ $post->created_at->format('M') }}</p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{ route('singlePost', [$post->id, $post->slug]) }}">
                                <h2>{{$post->title}}</h2>
                            </a>
                            <p>{{ $post->subtitle }}</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="far fa-user"></i>
                                        @foreach ($post->tags as $tag )
                                        <span class="badge badge-success" style="background-color: rgb(247, 250, 240)"><a href="{{ route('tagPosts',$tag->id)}}">{{ $tag->name }}</a></span>
                                        @endforeach
                                    </a></li>
                                <li><a href="#"><i class="far fa-comments"></i> {{ $post->comments->count() }} Comments</a> Comments</a></li>
                            </ul>
                        </div>
                    </article>
                    @endforeach
                </div>
                {{$posts->links('vendor.pagination.bootstrap-4')}}
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <search-post-component></search-post-component>
                    </aside>
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Categories</h4>
                        <ul class="list cat-list">
                            @foreach ($categories as $category )
                            <li>
                                <a href="{{ route('categoryPosts',[$category->id]) }}" class="d-flex">
                                    <p>{{ $category->name }}</p>
                                    <p>({{ $category->posts->count() }})</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Post</h3>
                        @foreach ($recentPosts as $recentPost )
                        <div class="media post_item">
                            <img src="{{ asset('post-image/'.$recentPost->image) }}" alt="post" style="width: 70px">
                            <div class="media-body">
                                <a href="{{ route('singlePost',[$recentPost->id,$recentPost->slug]) }}">
                                    <h3>{{ Str::limit($post->title, 25, '...') }}</h3>
                                </a>
                                <p>{{ $post->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            @foreach ($tags as $tag)
                            <li>
                                <a href="{{ route('tagPosts',$tag->id)}}">{{ $tag->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="single_sidebar_widget instagram_feeds">
                        <h4 class="widget_title">Instagram Feeds</h4>
                        <ul class="instagram_row flex-wrap">
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('blog/img/post/post_5.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('blog/img/post/post_6.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('blog/img/post/post_7.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('blog/img/post/post_8.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('blog/img/post/post_9.png') }}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="{{ asset('blog/img/post/post_10.png') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </aside>


                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>

                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder="Enter email" required="">
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')


@endsection
