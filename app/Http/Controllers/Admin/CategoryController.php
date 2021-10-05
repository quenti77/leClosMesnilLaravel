<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View|Factory
    {
        $categories = Category::all();
        $posts =Post::all();

        return view('admin.category.index', compact('categories','posts'));
    }

    public function create(): View|Factory
    {
        return view('admin.category.create');
    }

    public function store(CategoryStoreRequest $request): Redirector|RedirectResponse
    {
        $category = $this->storeCategory($request->all());

        $category->save();

        return redirect()
            ->route('admin.category.show', $category->slug)
            ->with(['success' => 'Création de l\'article']);
    }

    public function show(string $slug): View|Factory
    {
        $category = Category::where("slug","=", $slug)->first();
        $posts = Post::all();
        return view("admin.category.show", compact('category',"posts"));
    }


    public function edit(int $id): View|Factory
    {
        $category = Category::find($id);

        return view("admin.category.edit", compact('category'));
    }

    public function update(CategoryStoreRequest $request, Category $category): Redirector|RedirectResponse
    {
        $this->storeCategory($request->all(), $category);

        $category->save();

        return redirect()
            ->route('admin.category.show', $category->id)
            ->with(['success' => 'Modification de la catégorie']);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with(['success' => 'La catégorie est bien supprimé']);
    }

    private function storeCategory(array $categoryData, Category|null $category = null): Category
    {
        $category ??= new Category();
        $category->name = $categoryData['name'];
        $category->slug = Str::slug($category->name);
        $category->save();

        return $category;
    }
}
