<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerCard extends Model
{
    public $maxPrice = [
        5  => 175000,
        8  => 184400,
        11 => 185600,
        13 => 185625,
    ];

    public $priceLevels = [
        5  => [
            1 => 0,
            2 => 5000,
            3 => 25000,
            4 => 75000,
            5 => 175000
        ],
        8  => [
            1 => 0,
            2 => 400,
            3 => 2400,
            4 => 6400,
            5 => 14400,
            6 => 34400,
            7 => 84400,
            8 => 184400,
        ],
        11 => [
            1  => 0,
            2  => 50,
            3  => 200,
            4  => 600,
            5  => 1600,
            6  => 3600,
            7  => 7600,
            8  => 15600,
            9  => 35600,
            10 => 85600,
            11 => 185600,
        ],
        13 => [
            1  => 0,
            2  => 5,
            3  => 25,
            4  => 75,
            5  => 225,
            6  => 625,
            7  => 1625,
            8  => 3625,
            9  => 7625,
            10 => 15625,
            11 => 35625,
            12 => 85625,
            13 => 185625,
        ],
    ];

    public $maxCards = [
        5  => 36,
        8  => 386,
        11 => 2586,
        13 => 9586,
    ];

    public $collectedLevels = [
        5  => [
            1  => 0,
            2  => 2,
            3  => 6,
            4  => 16,
            5  => 36,
        ],
        8  => [
            1  => 0,
            2  => 2,
            3  => 6,
            4  => 16,
            5  => 36,
            6  => 86,
            7  => 186,
            8  => 386,
        ],
        11 => [
            1  => 0,
            2  => 2,
            3  => 6,
            4  => 16,
            5  => 36,
            6  => 86,
            7  => 186,
            8  => 386,
            9  => 786,
            10 => 1586,
            11 => 2586,
        ],
        13 => [
            1  => 0,
            2  => 2,
            3  => 6,
            4  => 16,
            5  => 36,
            6  => 86,
            7  => 186,
            8  => 386,
            9  => 786,
            10 => 1586,
            11 => 2586,
            12 => 4586,
            13 => 9586,
        ],
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'id', 'card_id');
    }

    public function setCollectedAmounts()
    {
        $this->collected_total = $this->collectedLevels[$this->maxLevel][$this->level] + $this->count;
        $this->available_to_collect_total = $this->maxCards[$this->maxLevel];
        $this->spent = $this->priceLevels[$this->maxLevel][$this->level];
        $this->price_to_max = $this->maxPrice[$this->maxLevel];
    }
}
