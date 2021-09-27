<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CommentPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index(): View|Factory
    {
        $posts = Post::OrderByDesc('created_at')->paginate(35);

        return view('post', compact('posts'));
    }

    public function getComment(): View|Factory
    {
        $comments = CommentPost::all();
        return view('post', compact('comments'));
    }

    public function showPost(string $slug, Post $post): View|Factory
    {
        $post = Post::with('comments.user')->where('slug', $slug)->first();
        $comments = $post->comments;
        return view('single', compact('post', 'comments'));
    }
}
