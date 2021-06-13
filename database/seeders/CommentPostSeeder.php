<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\CommentPost;
use Illuminate\Database\Seeder;

class CommentPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommentPost::factory()
            ->count(5)
            ->create();
    }
}
