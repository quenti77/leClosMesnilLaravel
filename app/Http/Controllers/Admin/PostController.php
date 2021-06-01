<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts',));
    }

    public function create()
    {
        $post = Post::all();
        $category = Category::all();
        return view('admin.post.create' , compact('post','category'));
    }

    public function show($id)
    {
        dd($id);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $category = Category::All();
        return view('admin.post.edit', compact('post','category'));
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image_path'=> 'required'
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->slug = Str::slug($post->title);
        $post->category_id = $validated['category_id'];
        $post->image_path = $validated['image_path'];
        $post->user_id = Auth::user()->id;
        $post->save();

        $request->session()->flash('success', 'Enregister');
        return redirect()->route('admin.post.show', $post->id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image-path' => 'image-path'
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->save();
        return redirect()->route('admin.post.show', $post->id);
    }



}
