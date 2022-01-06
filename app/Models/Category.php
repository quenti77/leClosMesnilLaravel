<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Category extends Model
{
    use HasFactory, Uuid;

    protected $table = 'categories';

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
