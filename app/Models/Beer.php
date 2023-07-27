<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory, Uuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function brand()
    {
        return $this->hasOne(BeerBrand::class);
    }

    public function places()
    {
        return $this->hasMany(BeerPlace::class);
    }

    public function ratings()
    {
        return $this->hasOne(BeerRatingTotal::class);
    }

    public function images()
    {
        return $this->hasMany(BeerImage::class);
    }

    public function translations()
    {
        return $this->hasMany(BeerTranslation::class);
    }
}
