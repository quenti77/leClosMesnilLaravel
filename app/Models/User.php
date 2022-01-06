<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property bool $is_admin
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property DateTime $email_verified_at
 * @property string $password
 * @property string $phone
 * @property string $remember_token
 * @property DateTime $created_at
 * @property DateTime $updated_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(CommentPost::class, 'author_id');
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
