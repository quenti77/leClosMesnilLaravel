<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\CommentPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index(): View|Factory
    {
        $posts = Post::OrderByDesc('created_at')->paginate(12);
        $resPagination = Post::OrderByDesc('created_at')->paginate(6);
        $lastPosts = Post::OrderByDesc('created_at')->limit(5)->get();
        $categories = Category::all();

        return view('post', compact('posts','categories','lastPosts', 'resPagination'));
    }

    public function getComment(): View|Factory
    {
        $comments = CommentPost::all();
        return view('post', compact('comments'));
    }

    public function show(string $slug): View|Factory
    {
        $post = Post::with('comments.user')->where('slug', $slug)->first();
        $comments = $post->comments;
        return view('single', compact('post', 'comments'));
    }
}
