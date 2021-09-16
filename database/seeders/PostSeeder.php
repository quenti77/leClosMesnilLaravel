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
            ->count(50)
            ->create();
    }
}
