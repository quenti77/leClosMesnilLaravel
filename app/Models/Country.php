<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'countries';

    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'english_name',
        'code'
    ];

    public function users()
    {
        return $this->hasMany(Users::class);
    }
}
