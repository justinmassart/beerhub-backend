<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoneVerification extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['user_id', 'user_phone', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
