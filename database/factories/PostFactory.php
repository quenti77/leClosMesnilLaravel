<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->name;
        $slug = Str::slug($title);
        return [
            'id' => $this->faker->unique()->numberBetween(1, 20),
            'user_id' => $this->faker->numberBetween(1, 20),
            'category_id' => $this->faker->numberBetween(1, 20),
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->sentence(6, true),
            'image_path' => 'https://via.placeholder.com/150',
            'comment_count' => $this->faker->randomDigit(),
        ];
    }
}
