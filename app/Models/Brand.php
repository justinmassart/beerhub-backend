<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Brand extends Model
{
    use HasFactory, Uuids, Searchable;

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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
