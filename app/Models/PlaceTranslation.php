<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceTranslation extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
