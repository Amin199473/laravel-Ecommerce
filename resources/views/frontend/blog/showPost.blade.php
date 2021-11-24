@extends('frontend.layouts.master')




@section('head')
<link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
<meta name="description" content="{{ $post->meta_description }}">
<meta name="keywords" content="{{ $post->meta_keywords }}">
<title>{{ $post->seo_title }}</title>
@endsection



@section('content')
<section class="blog_area single-post-area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="card-img rounded-0" src="{{ asset('post-image/'.$post->image) }}" alt="">
                    </div>
                    <div class="blog_details">
                        <h2>
                            {{ $post->title }}
                        </h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="far fa-user"></i>
                                    @foreach ( $post->tags as $tag)
                                    <span class="badge badge-success" style="background-color: rgb(250, 253, 245)"><a href="{{ route('tagPosts',$tag->id)}}">{{ $tag->name }}</a></span>
                                    @endforeach
                                </a></li>
                            <li><a href="#"><i class="far fa-comments"></i> {{ $post->comments->where('approved',1)->count() }} Comments</a></li>
                        </ul>
                        <p>
                            {!! $post->body !!}
                        </p>

                    </div>
                </div>
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">
                        <p class="like-info"><span class="align-middle"><i class="far fa-heart"></i></span> Lily and 4
                            people like this</p>
                        <div class="col-sm-4 text-center my-2 my-sm-0">
                        </div>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                    </div>
                    <div class="navigation-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/preview.png" alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="lnr text-white ti-arrow-left"></span>
                                    </a>
                                </div>
                                <div class="detials">
                                    @if($previousPost)
                                    <p>Prev Post</p>
                                    <a href="{{ route('singlePost',[$previousPost->id,$previousPost->slug]) }}">
                                        <h4>{{Str::limit($previousPost->title, 15, '...')  }}</h4>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    @if($nextPost)
                                    <p>Next Post</p>
                                    <a href="{{ route('singlePost',[$nextPost->id,$nextPost->slug]) }}">
                                        <h4>{{Str::limit($nextPost->title, 15, '...')  }}</h4>
                                    </a>
                                    @endif
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="lnr text-white ti-arrow-right"></span>
                                    </a>
                                </div>
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/next.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-author">
                    <div class="media align-items-center">
                        @if($post->user->profile->avatar)
                        <img src="{{ asset('avatar-image/'.$post->user->profile->avatar) }}" alt="{{ $post->user->name }}">
                        @else
                        <img src="{{ asset('backend/dist/img/avatar3.png') }}" alt="{{ $post->user->name }}">
                        @endif
                        <div class="media-body">
                            <h4>{{ $post->user->name }}</h4>

                            <p>{{ $post->user->profile->bio  }}</p>
                        </div>
                    </div>
                </div>
                <div class="comments-area">
                    <h4><h4><i class="far fa-comments"></i> {{ $post->comments->where('approved',1)->count() }} Comments</h4></h4>
                </div>
                @comments(['model' => $post,'approved' => true])
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
                        @foreach ($posts as $singlePost )
                        <div class="media post_item">
                            <img src="{{ asset('post-image/'.$singlePost->image) }}" alt="{{ Str::limit($post->title, 10, '...') }}" width="70px">
                            <div class="media-body">
                                <a href="{{ route('singlePost',[$singlePost->id,$singlePost->slug]) }}">
                                    <h3>{{ Str::limit($singlePost->title, 25, '...')  }}</h3>
                                </a>
                                <p>{{ $singlePost->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </aside>
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            @foreach ($post->tags as $tag)
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
