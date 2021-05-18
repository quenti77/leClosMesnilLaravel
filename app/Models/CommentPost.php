<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $post_id
 * @property string $author
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class CommentPost extends Model
{
    use HasFactory;

    protected $table = 'comments_post';
}
