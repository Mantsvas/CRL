<?php

namespace App\Console\Commands;

use App\Http\Constants\Constants as Cnst;
use Illuminate\Console\Command;
use App\Services\ClashRoyaleService as CRApi;
use App\Services\PlayerService;
use App\Services\ClanService;
use App\Models\Player;
use App\Models\Clan;

class UpdateClanPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateClanPlayers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $api;
    protected $playerService;
    protected $clanService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->api = new CRApi;
        $this->playerService = new PlayerService;
        $this->clanService = new clanService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clanTags = Cnst::CLAN_TAGS;
        $clans = Clan::whereIn('tag', $clanTags)->with('players')->get();
        foreach ($clanTags as $tag) {
            // Update Clan
            $existingClan = $clans->where('tag', $tag)->first();
            $response = $this->api->getClan($tag);
            $this->clanService->createOrUpdate($response, $existingClan);

            // Update Clan players
            $playerTags = [];
            $existingPlayers = $existingClan->allPlayers;
            foreach ($response->memberList as $member) {
                $playerData = $this->api->getPlayer(ltrim($member->tag, '#'));
                $existingPlayer = $existingPlayers->where('tag', ltrim($member->tag, '#'))->first();
                $this->playerService->createOrUpdate($playerData, $existingPlayer);
                $playerTags[] = ltrim($member->tag, '#');
            }

            Player::whereNotIn('tag', $playerTags)->where('clan_tag', $tag)->update(['in_clan' => false]);
        }
    }
}
