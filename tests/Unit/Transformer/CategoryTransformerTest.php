<?php

namespace Tests\Unit\Transformer;

use App\Models\Category;
use App\Transformer\CategoryTransformer;
use Tests\TestCase;

class CategoryTransformerTest extends TestCase
{
    public function test_category_model_should_be_transform_to_array(): void
    {
        $expectedArray = [
            'id' => '00000000-0000-0000-1234-000000000000',
            'name' => 'Catégorie de test'
        ];

        $category = Category::factory()->create($expectedArray);

        $transformer = new CategoryTransformer();
        $transformed = $transformer->transform($category);
        $this->assertEqualsCanonicalizing($expectedArray, $transformed);
    }
}
