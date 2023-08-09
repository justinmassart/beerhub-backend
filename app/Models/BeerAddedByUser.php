<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeerAddedByUser extends Model
{
    use HasFactory, Uuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['beer_id', 'added_by_user_id'];

    public function beer()
    {
        return $this->belongsTo(Beer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
