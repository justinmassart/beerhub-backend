<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function brand()
    {
        $this->hasOne(Brand::class);
    }
}
