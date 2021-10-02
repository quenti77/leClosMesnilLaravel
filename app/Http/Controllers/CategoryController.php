<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class CategoryController extends Controller
{
    public function show(string $slug): View|Factory
    {
        $categories = Category::all();
        $category = Category::where('slug', '=', $slug)->first();
        $posts = Post::OrderByDesc('created_at')->where('category_id', '=', $category->id)->paginate(35);
        return view('post', compact('posts', 'categories', 'category'));
    }
}
