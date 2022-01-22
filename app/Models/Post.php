<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $user_id
 * @property string $category_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $image_path
 * @property int $comment_count
 * @property Collection<CommentPost> $comments
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $published_at
 */
class Post extends Model
{
    use HasFactory, Uuid;

    protected $table = 'posts';

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentPost::class, 'post_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSortCategory(mixed $query, string $sortDirection): mixed
    {
        $method = $sortDirection === 'asc' ? 'orderBy' : 'orderByDesc';

        $categoryQuery = Category::select('name')
            ->whereColumn('categories.id', 'posts.category_id')
            ->orderBy('name', $sortDirection)
            ->limit(1);

        return $query->{$method}($categoryQuery);
    }
}
