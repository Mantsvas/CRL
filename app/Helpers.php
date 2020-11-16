<?php

namespace App;

use Carbon\Carbon;

class Helpers
{
    public static function convertUTCDate($str)
    {
        $date = '';
        if ($str) {
            $date = $str[0] . $str[1] . $str[2] . $str[3] . '-' . $str[4] . $str[5] . '-' . $str[6] . $str[7] . ' ' . $str[9] . $str[10] . ':' . $str[11] . $str[12] . ':' . $str[13] . $str[14];
            $date = Carbon::parse($date);
            $date->addHours(7);
        }

        return $date;
    }
}
