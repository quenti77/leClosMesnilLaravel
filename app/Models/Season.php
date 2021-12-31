<?php

namespace App\Models;

use App\Models\Traits\PeriodableScope;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property DateTime $started_at
 * @property DateTime $finished_at
 * @property int $price
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Season extends Model
{
    use HasFactory, PeriodableScope;

    protected $table = 'seasons';

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
        static::creating(function ($seasons) {
            $seasons->id = (string) Str::uuid();
        });
    }
}
