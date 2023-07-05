<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceRating extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beer()
    {
        return $this->belongsTo(Place::class);
    }
}
