<?php

namespace Database\Factories;

use App\Models\CommentPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentPostFactory extends Factory
{
    protected $model = CommentPost::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        return [
            'post_id' => Post::factory(),
            'author_id' => User::factory()->active(),
            'content' => $this->faker->paragraph()
        ];
    }
}
