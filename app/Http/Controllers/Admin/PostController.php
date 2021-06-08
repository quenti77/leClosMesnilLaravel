<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View|Factory
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts',));
    }

    public function create(): View|Factory
    {
        $post = Post::all();
        $category = Category::all();
        return view('admin.post.create' , compact('post','category'));
    }

    public function show($id)
    {
        dd($id);
    }

    public function edit(int $id): View|Factory
    {
        $post = Post::find($id);
        $category = Category::All();
        return view('admin.post.edit', compact('post','category'));
    }

    public function store(Request $request): String|Int|Bool|Array
    {
        $validated = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'image_path'=> 'required'
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->slug = Str::slug($post->title);
        $post->category_id = $validated['category_id'];
        $post->image_path = $validated['image_path'];
        $post->user_id = (string) Auth::id();
        $post->save();

        $request->session()->flash('success', 'Enregister');
        return redirect()->route('admin.post.show', $post->id);
    }

    public function update(Request $request,int $id): String|Int|Bool|Array
    {
        $validated = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'image_path'=> 'required'
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->slug = Str::slug($post->title);
        $post->category_id = $validated['category_id'];
        $post->image_path = $validated['image_path'];
        $post->user_id = (string) Auth::id();
        $post->save();

        $request->session()->flash('success', 'Enregister');
        return redirect()->route('admin.post.show', $post->id);
    }
}
