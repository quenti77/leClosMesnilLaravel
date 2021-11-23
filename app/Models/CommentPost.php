<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $post_id
 * @property string $author
 * @property string $content
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class CommentPost extends Model
{
    use HasFactory;

    protected $table = 'comments_post';


    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
