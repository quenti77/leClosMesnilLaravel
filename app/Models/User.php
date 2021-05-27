<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

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

    protected static function booted()
    {
        static::creating(function($user){
            $user->id = (string) Str::uuid();
        });
    }

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }
}
