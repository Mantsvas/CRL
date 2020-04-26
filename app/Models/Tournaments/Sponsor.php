<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'tournament_id', 'title', 'url', 'notes'
    ];

    public function image()
    {
        return $this->morphOne('App\Models\Upload', 'uploadable');
    }
}
