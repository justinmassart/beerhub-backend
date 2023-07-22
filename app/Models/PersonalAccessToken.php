<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
