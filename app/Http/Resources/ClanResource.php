<?php

namespace App\Http\Resources;

use App\Http\Resources\PlayerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tag'                => $this->tag,
            'name'               => $this->name,
            'type'               => $this->inviteType,
            'badgeId'            => $this->badgeId,
            'clanScore'          => $this->clanScore,
            'clanWarTrophies'    => $this->clanWarTrophies,
            'description'        => $this->description,
            'requiredTrophies'   => $this->requiredTrophies,
            'donationsPerWeek'   => $this->donationsPerWeek,
            'members'            => $this->members,
            'membersList'        => $this->membersList,
            'players'            => PlayerResource::collection($this->players),
        ];
    }
}
