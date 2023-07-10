<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerRating extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }
}