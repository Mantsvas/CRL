<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'user_id', 'provider', 'provider_id'
    ];
}
