<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function setType(): void
    {
        switch ($this->maxLevel) {
            case 13:
                $this->type = 'common';
                break;
            case 11:
                $this->type = 'rare';
                break;
            case 8:
                $this->type = 'epic';
                break;
            case 5:
                $this->type = 'legendary';
                break;
            default:
                $this->type = 'unknown';
        }
    }
}
