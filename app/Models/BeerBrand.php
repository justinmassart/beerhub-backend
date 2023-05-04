<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerBrand extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
