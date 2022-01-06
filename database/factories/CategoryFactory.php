<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        $name = $this->faker->words(6, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
