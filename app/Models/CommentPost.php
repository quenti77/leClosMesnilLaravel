<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $post_id
 * @property string $author
 * @property string $content
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class CommentPost extends Model
{
    use HasFactory;

    protected $table = 'comments_post';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(function ($comments_posts) {
            $comments_posts->id = (string) Str::uuid();
        });
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
