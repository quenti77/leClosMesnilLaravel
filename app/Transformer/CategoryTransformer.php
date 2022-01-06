<?php

namespace App\Transformer;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name
        ];
    }
}
