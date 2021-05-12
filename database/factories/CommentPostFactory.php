<?php

namespace Database\Factories;

use App\Models\CommentPost;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'post_id' => $this->faker->uuid,
            'author' => $this->faker->name,
        ];
    }
}
