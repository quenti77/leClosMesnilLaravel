<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CommentPost;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        $persona = config('lcm.persona');

        $this->users($persona['users']);
        $this->categories($persona['post_categories']);
        $this->posts($persona['posts']);
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    private function users(array $users): void
    {
        foreach ($users as $user) {
            $userFactory = User::factory();

            $active = (bool) $user['active'] ?? false;
            $admin = (bool) $user['admin'] ?? false;

            if ($active) {
                $userFactory = $userFactory->active();
            }
            if ($admin) {
                $userFactory = $userFactory->admin();
            }

            unset($user['active']);
            unset($user['admin']);
            $userFactory->create($user);
        }
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    private function categories(array $categories): void
    {
        foreach ($categories as $category) {
            Category::factory()->create($category);
        }
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    /**
     * @throws Exception
     */
    private function posts(array $posts): void
    {
        $authors = User::query()->whereIn('id', $posts['authors'])->pluck('id')->toArray();
        $categories = Category::query()->whereIn('id', $posts['categories'])->get();

        $commentUser = User::factory()->active()->create();

        foreach ($categories as $category) {
            $postsPerCategory = random_int(...$posts['posts_per_category']);
            $commentsPerPost = random_int(...$posts['comments_per_post']);

            $commentPostFactory = CommentPost::factory()
                ->for($commentUser, 'user')
                ->count($commentsPerPost);

            $postState = fn (array $attributes, mixed $post) => ['user_id' => $authors[array_rand($authors)]];

            Post::factory()
                ->for($category)
                ->has($commentPostFactory, 'comments')
                ->state($postState)
                ->count($postsPerCategory)
                ->published()
                ->create([ 'comment_count' => $commentsPerPost ]);
        }
    }
}
