<?php

namespace App\Transformer\Admin;

use App\Models\Category;
use DateTime;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category): array
    {
        /** @var string $updated */
        $updated = $category->updated_at;
        $updatedAt = new DateTime($updated);

        return [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'updated' => $updatedAt->format('d/m/Y'),
            'count' => $category->posts_count
        ];
    }
}
