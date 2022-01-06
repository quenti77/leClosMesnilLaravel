<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Optimizer\OptimizerChainFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use MyLogger;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View|Factory
    {
        $posts = Post::OrderByDesc('created_at')->paginate(30);

        return view('admin.post.index', compact('posts'));
    }

    public function create(): View|Factory
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function show(Post $post): View|Factory
    {
        return view('admin.post.show')->with('post', $post);
    }

    public function edit(int $id): View|Factory
    {
        $post = Post::find($id);
        $categories = Category::All();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function store(PostStoreFormRequest $request): Redirector|RedirectResponse
    {
        $post = $this->storePost($request->all());

        /** @var UploadedFile $file */
        $file = $request->file('image_path');

        $filename = $request->get('image_name') . "." . $file->extension();
        $file->storeAs('img', $filename ,'public');
        $path = 'C:\\DEV\\leClosMesnilLaravel\\storage\\app\\public\\img\\' . $filename;
        $filenameOpti = $request->get('image_name') . "Opti" . "." . $file->extension();
        $pathOpti = "C:\\DEV\\leClosMesnilLaravel\\storage\\app\\public\\img\\" .$filenameOpti;
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->useLogger(new MyLogger());
        $optimizerChain->optimize($path, $pathOpti);

        $post->image_path = $filenameOpti;
        $post->save();

        return redirect()
            ->route('admin.post.show', $post->id)
            ->with(['success' => 'Création de l\'article']);
    }

    public function update(PostStoreFormRequest $request, Post $post): Redirector|RedirectResponse
    {
        $filepath = storage_path('app/public/img/' . $post->image_path);
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        $this->storePost($request->all(), $post);

        /** @var UploadedFile $file */
        $file = $request->file('image_path');

        $filename = $request->get('image_name') . "." . $file->extension();
        $file->storeAs('img', $filename ,'public');
        $path = 'C:\\DEV\\leclosmesnil\\storage\\app\\public\\img\\' . $filename;
        $filenameOpti = $request->get('image_name') . "Opti" . "." . $file->extension();
        $pathOpti = "C:\\DEV\\leclosmesnil\\storage\\app\\public\\img\\" .$filenameOpti;
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->useLogger(new MyLogger());
        $optimizerChain->optimize($path, $pathOpti);

        $post->image_path = $filenameOpti;
        $post->save();

        return redirect()
            ->route('admin.post.show', $post->id)
            ->with(['success' => 'Modification de l\'article']);
    }

    private function storePost(array $postData, Post|null $post = null): Post
    {
        $post ??= new Post();
        $post->title = $postData['title'];
        $post->content = $postData['content'];
        $post->slug = Str::slug($post->title);
        $post->category_id = $postData['category_id'];
        $post->user_id = (string) Auth::id();
        $post->image_path = $postData['image_path'];
        $post->save();

        return $post;
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        $filepath = storage_path('app/public/img/' . $post->image_path);
        unlink($filepath);
        return redirect()
            ->route('admin.post.index')
            ->with(['success' => 'L\'article est bien supprimé']);
    }
}
