<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\CommentPost;
use App\Transformer\FractalTransformer;
use App\Transformer\PostTransformer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{
    use FractalTransformer;

    public function index(): View|Factory
    {
        $posts = Post::OrderByDesc('created_at')->paginate(6);
        $nextAvailable = $posts->nextPageUrl() === null ? 0 : 1;
        $lastPosts = Post::OrderByDesc('created_at')->limit(5)->get();
        $categories = Category::all();
        $currentPath = route(Route::currentRouteName());

        return view('post', compact('posts', 'categories', 'lastPosts', 'currentPath', 'nextAvailable'));
    }

    public function getPost(Request $request): \Illuminate\Http\JsonResponse
    {
        $postQuery = Post::with('category')->OrderByDesc('created_at');
        if ($request->cat !== null) {
            $postQuery->where('category_id', $request->cat);
        }
        $paginator = $postQuery->paginate(6);
        $posts = $paginator->getCollection();

        return response()->json($this->collection($posts, new PostTransformer(), $paginator));
    }

    public function getCategory(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getComment(): View|Factory
    {
        $comments = CommentPost::all();
        return view('post', compact('comments'));
    }

    public function show(string $slug): View|Factory
    {
        $post = Post::with('comments.user')->where('slug', $slug)->first();
        $comments = $post->comments->sortByDesc('created_at');
        $categories = Category::all();
        return view('single', compact('post', 'comments', 'categories'));
    }
}
