<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory, Uuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
