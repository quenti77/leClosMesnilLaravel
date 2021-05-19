<?php 

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function getPost()
    {
        $posts = Post::all();
        return view('post', compact('posts'));
    }
}