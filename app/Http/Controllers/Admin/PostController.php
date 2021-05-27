<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //     /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'title' => ['required', 'string', 'max:255'],
    //         'content' => ['required', 'string'],
    //         'image-path' => ['required', 'string', 'max:255']
    //     ]);
    // }

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }
    /**
     * Il va chercher la view create pour un post
     */
    public function create()
    {
        return view('admin.post.create');
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.post.edit')->with('post', $post);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->descriptions = $validated['descriptions'];


        $post->save();
        $request->session()->flash('success', 'Enregister');
        return redirect()->route('admin.post.show', $post->id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->save();
        return redirect()->route('admin.post.show', $post->id);
    }

}
