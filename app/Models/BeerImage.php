<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class);
    }
}
