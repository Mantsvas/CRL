<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Clan;
use App\Models\RiverRace;
use App\Models\CurrentRiverRace;

class ClanService
{
    public function updateOrCreate(Object $data)
    {
        $clan = Clan::where('tag', ltrim($data->tag, '#'))->first();
        if (!$clan) {
            $clan = new Clan;
            $clan->tag = ltrim($data->tag, '#');
        }

        $clan->name = $data->name;
        $clan->location_id = $data->location->id ?? null;
        $clan->type = $data->type;
        $clan->description = $data->description;
        $clan->badgeId = $data->badgeId;
        $clan->clanScore = $data->clanScore;
        $clan->clanWarTrophies = $data->clanWarTrophies;
        $clan->requiredTrophies = $data->requiredTrophies;
        $clan->donationsPerWeek = $data->donationsPerWeek;
        $clan->members = $data->members;
        $clan->memberList = json_encode($data->memberList);
        $clan->save();
    }

    public function updateCurrentRiverRace($data)
    {
        $riverRace = CurrentRiverRace::where('clan_tag', ltrim($data->clan->tag, '#'))->first();
        if (!$riverRace) {
            $riverRace = new CurrentRiverRace;
            $riverRace->clan_tag = ltrim($data->clan->tag, '#');
        }

        $clansScore = collect($data->clans);
        foreach ($clansScore as $score) {
            $str = $score->finishTime ?? '3000';
            if ($str !== '3000') {
                $date = $str[0] . $str[1] . $str[2] . $str[3] . '-' . $str[4] . $str[5] . '-' . $str[6] . $str[7] . ' ' . $str[9] . $str[10] . ':' . $str[11] . $str[12] . ':' . $str[13] . $str[14];
                $score->finishTime = $date;
            } else {
                $score->finishTime = '3000';
            }
        }

        $clansScore = $clansScore->sortByDesc('fame')->sortBy('finishTime');
        foreach ($clansScore as $score) {
            if ($score->finishTime === '3000') {
                $score->finishTime = null;
            } else {
                $date = Carbon::parse($score->finishTime);
                $date->addHours(7);
                $score->finishTime = $date->format('Y-m-d H:i:s');
            }
        }


        $riverRace->clans = json_encode($clansScore);

        $riverRace->sectionIndex = $data->sectionIndex;
        $riverRace->fame = $data->clan->fame ?? null;
        $riverRace->repairPoints = $data->clan->repairPoints ?? null;
        $riverRace->finishTime = $data->clan->finishTime ?? null;
        $riverRace->participants = json_encode($data->clan->participants ?? []);
        $riverRace->clanScore = $data->clan->clanScore ?? null;
        $riverRace->save();
    }

    public function updateRiverRaceLog($data)
    {
        $riverRace = RiverRace::where(['seasonId' => $data->seasonId, 'sectionIndex' => $data->sectionIndex])
                        ->where('clan_tags', 'like', '%' . ltrim($data->standings[0]->clan->tag, '#') . '%')
                        ->first();        
        if (!$riverRace) {
            $clanTags = '';
            foreach ($data->standings as $standing) {
                $clanTags .= ltrim($standing->clan->tag, '#') . ',';
            }
            $riverRace = new RiverRace;
            $riverRace->seasonId = $data->seasonId;
            $riverRace->sectionIndex = $data->sectionIndex;
            $riverRace->clan_tags = $clanTags;
        }

        $riverRace->createdDate = $data->createdDate;
        $riverRace->standings = json_encode($data->standings);
        $riverRace->save();

        foreach ($data->standings as $standing) {
            $this->attachRiverRaceToClan($standing->clan->tag, $riverRace->id);
        }
    }

    public function attachRiverRaceToClan($tag, $riverRaceId)
    {
        $clan = Clan::where('tag', ltrim($tag, '#'))->first();
        if ($clan) {
            $clan->riverRaces()->syncWithoutDetaching([$riverRaceId]);
        }
    }
}