<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\Sorters;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Transformer\Admin\CategoryTransformer;
use App\Transformer\Admin\PostTransformer;
use App\Transformer\FractalTransformer;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use FractalTransformer, Sorters;

    public const POSTS_SORTERS = [
        'title' => 'title',
        'category' => 'category.name',
        'updated' => 'updated_at',
        'publish' => 'published_at'
    ];

    public const CATEGORIES_SORTERS = [
        'name' => 'name',
        'updated' => 'updated_at'
    ];

    public function getPosts(Request $request): JsonResponse
    {
        $page = (int) $request->get('page', 1);
        $perPage = (int) $request->get('perPage', 10);
        $sorters = $this->transformInputSorters($request->get('sorters'));

        $query = Post::query()->with(['category']);
        $query = $this->sortsQuery($query, $sorters, self::POSTS_SORTERS);
        $query = $this->applySortCategory($query, $sorters);

        $paginator = $query->clone()->paginate($perPage);
        if ($paginator->lastPage() < $page || $page < 1) {
            $paginator = $query->paginate($perPage, ['*'], 'page', 1);
        }

        $posts = $paginator->getCollection();

        return response()->json(
            $this->collection($posts, new PostTransformer(), $paginator)
        );
    }

    public function createPost(Request $request): JsonResponse
    {
        $post = $this->updatePostWithRequest(new Post(), $request);

        return response()->json(
            $this->item($post, new PostTransformer())
        );
    }

    public function updatePost(Post $post, Request $request): JsonResponse
    {
        return response()->json(
            $this->item($this->updatePostWithRequest($post, $request), new PostTransformer())
        );
    }

    public function deletePost(Post $post): JsonResponse
    {
        if ($post) {
            $post->delete();
        }
        return response()->json([]);
    }

    public function getCategories(Request $request): JsonResponse
    {
        if ($request->get('pagination', '1') === '0') {
            return $this->categories();
        }
        
        $page = (int) $request->get('page', 1);
        $perPage = (int) $request->get('perPage', 10);
        $sorters = $this->transformInputSorters($request->get('sorters'));

        $query = Category::query()->withCount('posts');
        $query = $this->sortsQuery($query, $sorters, self::CATEGORIES_SORTERS);

        $paginator = $query->clone()->paginate($perPage);
        if ($paginator->lastPage() < $page || $page < 1) {
            $paginator = $query->paginate($perPage, ['*'], 'page', 1);
        }

        $categories = $paginator->getCollection();

        return response()->json(
            $this->collection($categories, new CategoryTransformer(), $paginator)
        );
    }

    public function createCategory(Request $request): JsonResponse
    {
        $category = $this->updateCategoryWithRequest(new Category(), $request);

        return response()->json(
            $this->item($category, new CategoryTransformer())
        );
    }

    public function updateCategory(Category $category, Request $request): JsonResponse
    {
        return response()->json(
            $this->item($this->updateCategoryWithRequest($category, $request), new CategoryTransformer())
        );
    }

    public function deleteCategory(Category $category): JsonResponse
    {
        if ($category) {
            // TODO: All posts need deleted or moved ?
            $category->posts()->delete();
            $category->delete();
        }
        return response()->json([]);
    }

    private function categories(): JsonResponse
    {
        return response()->json(
            $this->collection(Category::all(), new CategoryTransformer())
        );
    }

    private function applySortCategory(mixed $query, array $sorters): mixed
    {
        $categorySort = $this->getSortByColumn('category', $sorters);
        if (empty($categorySort)) {
            return $query;
        }

        return $query->sortCategory($categorySort[1]);
    }

    private function updatePostWithRequest(Post $post, Request $request): Post
    {
        $except = empty($post->id) ? '' : ",{$post->id},id";

        $validated = $request->validate([
            'title' => 'required|min:3',
            'slug' => "required|min:3|unique:posts,slug{$except}",
            'content' => 'required|min:3',
            'category' => 'required|exists:categories,id',
            'publish' => 'required'
        ]);

        $post->title = $validated['title'];
        $post->slug = $validated['slug'];
        $post->content = $validated['content'];
        $post->category_id = $validated['category'];
        $post->user_id = auth()->id();
        $post->image_path = '';
        $post->comment_count = 0;

        if ($post->isPublished() !== $validated['publish']) {
            $post->published_at = $validated['publish'] ? new DateTime() : null;
        }

        $post->save();

        return $post;
    }

    private function updateCategoryWithRequest(Category $category, Request $request): Category
    {
        $except = empty($category->id) ? '' : ",{$category->id},id";

        $validated = $request->validate([
            'name' => 'required|min:3',
            'slug' => "required|min:3|unique:categories,slug{$except}"
        ]);

        $category->name = $validated['name'];
        $category->slug = $validated['slug'];

        $category->save();

        return $category;
    }
}
