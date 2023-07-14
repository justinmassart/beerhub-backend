<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function beers()
    {
        return $this->hasMany(BeerBrand::class);
    }

    public function translations()
    {
        return $this->hasMany(BrandTranslation::class);
    }
}
