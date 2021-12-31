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
        $users = User::all("id");
        $categories = Category::all("id");
        $title = $this->faker->sentences(1, true);
        $slug = Str::slug($title);
        return [
            'user_id' => $this->faker->randomElement($users),
            'category_id' => $this->faker->randomElement($categories),
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->sentences(30, true),
            'image_path' => 'https://via.placeholder.com/325x217',
            'comment_count' => 0,
        ];
    }
}
