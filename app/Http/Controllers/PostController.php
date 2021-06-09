<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\CommentPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function getPost(): View|Factory
    {
        $posts = Post::query()->orderByDesc('created_at')->get();
        return view('post', compact('posts'));
    }

    public function getComment(): View|Factory
    {
        $comments = CommentPost::all();
        return view('post', compact('comments'));
    }

}
