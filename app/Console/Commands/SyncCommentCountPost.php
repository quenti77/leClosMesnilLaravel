<?php

namespace App\Console\Commands;

use App\Models\CommentPost;
use App\Models\Post;
use Illuminate\Console\Command;

/**
 * Synchronise les commentaires des posts
 */
class SyncCommentCountPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lcm:sync_comment_count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync the number of comment for each post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::query()->with('comments')->get();

        foreach ($posts as $post) {
            $post->comment_count = $post->comments->count();
            $post->save();
        }

        return 0;
    }
}
