<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function clans()
    {
        return $this->hasMany(Clan::class, 'location_id');
    }
}
