<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function brand()
    {
        return $this->hasOne(BeerBrand::class);
    }

    public function places()
    {
        return $this->hasMany(BeerPlace::class);
    }

    public function translations()
    {
        return $this->hasMany(BeerTranslation::class);
    }
}
