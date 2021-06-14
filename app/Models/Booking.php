<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_id
 * @property DateTime $started_at
 * @property DateTime $finished_at
 * @property int $nb_night
 * @property int $nb_adult
 * @property int $nb_children
 * @property DateTime $payment_at
 * @property int $price
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
}
