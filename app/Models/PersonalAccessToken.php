<?php

namespace App\Models;

use App\Traits\GenerateRandomToken;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory, Uuids, GenerateRandomToken;

    protected $fillable = ['user_id', 'name', 'abilities', 'platform', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
