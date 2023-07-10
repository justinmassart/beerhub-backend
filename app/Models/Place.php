<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function beers()
    {
        return $this->hasMany(BeerPlace::class);
    }

    public function ratings()
    {
        return $this->hasMany(PlaceRatingTotal::class);
    }

    public function translations()
    {
        return $this->hasMany(PlaceTranslation::class);
    }
}
