<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function user()
    {
        $this->hasOne(User::class);
    }
}
