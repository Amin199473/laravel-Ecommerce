<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Notifications\NewPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        //Validations
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = 'image' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('post-image/');
            $request->file('image')->move($location, $filename);
        }

        $user_id = Auth::user()->id;

        $post = new Post();
        $post->user_id = $user_id;
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->image = $filename;
        $post->body = $request->body;
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status;
        $post->featured = $request->featured;
        $post->save();

        $listOfTags = explode(',', $request->tags);

        foreach ($listOfTags as $tag) {
            $repeatTag = Tag::where('name', $tag)->first();
            if (!isset($repeatTag)) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->slug = strtolower(str_replace(" ", "-", $tag));
                $tags->save();
                $post->tags()->attach($tags->id);
                $post->save();
            } else {
                $post->tags()->attach($repeatTag->id);
                $post->save();
            }
        }
        $this->newPost();
        return redirect()->back()->with('success', 'Post Add Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('model_type', 'App\Models\Post')->get();
        return view('admin.post.update', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //Validations
        $rules = [
            'title' => 'required', Rule::unique('posts', 'title')->ignore($post->id),
            'subtitle' => 'required|min:5',
            'slug' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:1024',
            'category' => 'required',
            'meta_description' => 'required|min:3',
            'meta_keywords' => 'required|min:3',
            'seo_title' => 'required|min:3',
        ];
        $customMessages = [
            'title.required' => 'The title must be 8 characters and unique title.',
            'subtitle.required' => ' subtitle is required',
            'slug.required' => 'the slug is required.',
            'tags.required' => 'post tags must be 3 characters and required',
            'body.required' => 'The body or content post is required.',
            'image.required' => 'The Image must be jpeg,jpg,png and 1MB size',
            'category.required' => 'the category is required.',
            'meta_description.required' => 'meta description must be at least 3 characters.',
            'meta_keywords.required' => 'meta keywords must be at least 3 characters.',
            'seo_title.required' => 'seo title is required.',
        ];
        $this->validate($request, $rules, $customMessages);
        if ($request->hasFile('image')) {
            //unlink old Images in public path
            $path = 'post-image/' . $post->image;
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            $photo = $request->file('image');
            $filename = 'image' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('post-image/');
            $request->file('image')->move($location, $filename);
        }
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->image = isset($filename) ? $filename : $post->image;
        $post->body = $request->body;
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;
        $post->status = $request->status;
        $post->featured = isset($request->featured) ? $request->featured : 0;
        $post->save();

        // $post->tags()->delete();
        $post->tags()->detach();

        $listOfTags = explode(',', $request->tags);

        foreach ($listOfTags as $tag) {
            $repeatTag = Tag::where('name', $tag)->first();
            if (!isset($repeatTag)) {
                $tags = new Tag();
                $tags->name = $tag;
                $tags->slug = strtolower(str_replace(" ", "-", $tag));
                $tags->save();
                $post->tags()->attach($tags->id);
                $post->save();
            } else {
                $post->tags()->attach($repeatTag->id);
                $post->save();
            }
        }
        return redirect()->back()->with('success', 'Post Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted Successfully');
    }

    public function deleteAll()
    {
        $posts = Post::get();
        if (!$posts->isEmpty()) {
            foreach ($posts as $post) {
                $post->delete();
            }
            return redirect()->back()->with('success', 'All Posts deleted succesfully');
        } else {
            return redirect()->back()->with('failed', 'There is none Post for delete');
        }
    }


    public function newPost()
    {
        $users = User::get();
        foreach ($users as $user) {
            if ($user->hasAnyRole('super-admin', 'admin', 'post-editor')) {
                $user->notify(new NewPost('The New Post created'));
            }
        }
    }
}
