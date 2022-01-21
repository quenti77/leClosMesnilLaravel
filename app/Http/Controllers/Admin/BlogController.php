<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\Sorters;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Transformer\Admin\PostTransformer;
use App\Transformer\FractalTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use FractalTransformer, Sorters;

    const POSTS_SORTERS = [
        'title' => 'title',
        'category' => 'category.name',
        'updated' => 'updated_at',
        'publish' => 'published_at'
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

    private function applySortCategory(mixed $query, array $sorters): mixed
    {
        $categorySort = $this->getSortByColumn('category', $sorters);
        if (empty($categorySort)) {
            return $query;
        }

        return $query->sortCategory($categorySort[1]);
    }
}
