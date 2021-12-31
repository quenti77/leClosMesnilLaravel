<?php

namespace Database\Factories;

use App\Models\CommentPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

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
        $users = User::all('id');
        $posts = Post::all('id');

        return [
            'post_id' => $this->faker->randomElement($posts),
            'author' => $this->faker->randomElement($users),
            'content' => $this->faker->paragraph(1)
        ];
    }
}
