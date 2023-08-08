<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceImage extends Model
{
    use HasFactory, Uuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }
}
