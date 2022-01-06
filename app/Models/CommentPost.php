<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $post_id
 * @property string $author_id
 * @property string $content
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Post $post
 */
class CommentPost extends Model
{
    use HasFactory, Uuid;

    protected $table = 'comments_post';

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
