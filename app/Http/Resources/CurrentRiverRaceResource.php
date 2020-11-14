<?php

namespace App\Http\Resources;

use Hlp;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentRiverRaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $clans = json_decode($this->clans);
        
        $newClans = [];
        foreach ($clans as $clan) {
            $newClans[] = $clan;
        }

        return [
            'clans'         => $newClans,
            'sectionIndex'  => $this->sectionIndex,
            'fame'          => $this->fame,
            'repairPoints'  => $this->repairPoints,
            'finishTime'    => Hlp::convertUTCDate($this->finishTime),
            'participants'  => json_decode($this->participants),
            'clanScore'     => $this->clanScore,
        ];
    }
}
