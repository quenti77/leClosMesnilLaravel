<?php

namespace Database\Seeders;

use App\Models\CommentPost;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(5)
            ->has(CommentPost::factory()->count(5), 'commentPost')
            // ->has(CategoryProject::factory()->count(5), 'categoryproject')
            ->create();

        Artisan::call('lcm:sync_comment_count');
    }
}
