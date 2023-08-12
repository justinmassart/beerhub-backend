<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Uuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public function user_preferences()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function phone_verification()
    {
        return $this->hasOne(UserPhoneVerification::class);
    }

    public function token()
    {
        return $this->hasOne(PersonalAccessToken::class);
    }

    public function added_beer()
    {
        return $this->hasMany(BeerAddedByUser::class);
    }
}
