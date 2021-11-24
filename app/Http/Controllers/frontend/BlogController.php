<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        $categories = Category::where('model_type', 'App\Models\Post')->get();
        $featured = Post::whereNotNull('featured')->inRandomOrder()->take(5)->get();
        $tags = Tag::inRandomOrder()->take(20)->get();
        return view('frontend.blog.index', compact('posts', 'categories', 'featured', 'tags'));
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        $previousPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id')->first();
        $posts = Post::latest()->take(5)->get();
        $categories = Category::where('model_type', 'App\Models\Post')->get();
        $featured = Post::whereNotNull('featured')->inRandomOrder()->take(5)->get();
        return view('frontend.blog.showPost', compact('post', 'posts', 'categories', 'featured', 'previousPost', 'nextPost'));
    }
    public function categoryPosts($id)
    {
        $posts = Post::where('category_id', $id)->paginate(5);
        $recentPosts = Post::latest()->take(5)->get();
        $categories = Category::where('model_type', 'App\Models\Post')->get();
        $featured = Post::whereNotNull('featured')->inRandomOrder()->take(5)->get();
        $tags = Tag::inRandomOrder()->take(20)->get();
        return view('frontend.blog.categoryPosts', compact('posts', 'categories', 'recentPosts', 'tags', 'featured'));
    }

    //this method shows related posts one tag
    public function tagPosts($id)
    {
        $tag = Tag::find($id);
        $posts = Post::join('post_tag', 'post_tag.post_id', '=', 'posts.id')
            ->where('post_tag.tag_id', $tag->id)
            ->selectRaw('posts.*')
            ->paginate(5);

        $recentPosts = Post::latest()->take(5)->get();
        $categories = Category::where('model_type', 'App\Models\Post')->get();
        $featured = Post::whereNotNull('featured')->inRandomOrder()->take(5)->get();
        $tags = Tag::inRandomOrder()->take(20)->get();
        return view('frontend.blog.tagPosts', compact('tag', 'categories', 'recentPosts', 'tags', 'featured', 'posts'));
    }
}