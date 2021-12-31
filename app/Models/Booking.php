<?php

namespace App\Models;

use App\Models\Traits\PeriodableScope;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $user_id
 * @property DateTime $started_at
 * @property DateTime $finished_at
 * @property string $content
 * @property int $nb_adult
 * @property int $nb_children
 * @property DateTime $payment_at
 * @property int $price
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Booking extends Model
{
    use HasFactory, PeriodableScope;

    protected $table = 'bookings';

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
        static::creating(function ($booking) {
            $booking->id = (string) Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
