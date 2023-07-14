<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function beer()
    {
        return $this->belongsTo(BeerImage::class);
    }

    public function place()
    {
        return $this->belongsTo(PlaceImage::class);
    }
}
