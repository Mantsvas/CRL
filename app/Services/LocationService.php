<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
    public function updateOrCreate($data)
    {
        $location = Location::where('id', $data->id)->first();
        if (!$location) {
            $location = new Location;
            $location->id = $data->id;
        }

        $location->name = $data->name;
        $location->isCountry = $data->isCountry;
        $location->countryCode = $data->countryCode ?? null;
        $location->save();
    }
}