<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property int $id
 * @property int $user_id
 * @property string $category_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $image_path
 * @property int $comment_count
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
