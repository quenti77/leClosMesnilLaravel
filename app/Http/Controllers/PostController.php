<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\CommentPost;

class PostController extends Controller
{
    public function getPost()
    {
        $posts = Post::OrderByDesc('created_at')->limit(10)->get();
        return view('post', compact('posts'));
    }

    public function getComment()
    {
        $comments = CommentPost::all();
        return view('post', compact('comments'));
    }

}
