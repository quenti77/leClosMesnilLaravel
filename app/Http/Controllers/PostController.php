<?php 

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function getPost()
    {
        $posts = Post::all();
        return view('post', compact('posts'));
    }

    public function getComment()
    {
        $comments = CommentPost::all();
        return view('post', compact('comments'));
    }

}