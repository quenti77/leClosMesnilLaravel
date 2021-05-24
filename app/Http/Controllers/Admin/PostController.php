<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
class PostController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
   public function create()
   {
       return view('admin.post.create');
   }

   public function index()
   {
       $posts = Post::all();
       return view('admin.post.index', compact('posts'));
   }
}
