<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();

        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        return [
            'user_id' => User::factory()->active()->admin(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(asText: true),
            'image_path' => 'https://via.placeholder.com/325x217',
            'comment_count' => 0
        ];
    }

    public function published(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'published_at' => new DateTimeImmutable()
        ]);
    }
}
