<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    public function show(string $slug): RedirectResponse|View|Factory
    {
        $categories = Category::all();
        /** @var Category|null $category */
        $category = Category::where('slug', '=', $slug)->first();
        if ($category === null) {
            return redirect()->route('index');
        }

        $currentPath = route(Route::currentRouteName() ?? '', ['slug'=>$slug]);
        $posts = Post::OrderByDesc('created_at')->where('category_id', '=', $category->id)->paginate(6);
        $nextAvailable = $posts->nextPageUrl() === null ? 0:1;
        $lastPosts = Post::OrderByDesc('created_at')->limit(5)->get();
        return view('post', compact('posts', 'categories', 'category','lastPosts','currentPath', 'nextAvailable'));
    }
}
