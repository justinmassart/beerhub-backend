<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerPlace extends Model
{
    use HasFactory, Uuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
