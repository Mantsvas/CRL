<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiverRace extends Model
{
    protected $casts = [
        'standings' => 'array',
    ];
}
