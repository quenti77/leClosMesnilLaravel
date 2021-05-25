<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image-path' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
   public function create(array $data)
   {
    return Post::create([
        'title' => $data['title'],
        'content' => $data['content'],
        'image-path' => $data['image-path']
    ]);
       return view('admin.post.create');
   }

   public function index()
   {
       $posts = Post::all();
       return view('admin.post.index', compact('posts'));
   }
}
