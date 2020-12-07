<?php

namespace App\Console\Commands;

use App\Http\Constants\Constants as Cnst;
use Illuminate\Console\Command;
use App\Services\ClashRoyaleService as CRApi;
use App\Services\PlayerService;
use App\Services\ClanService;
use App\Models\Player;
use App\Models\Clan;

class UpdateClans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateClans';

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
    public function __construct(CRApi $api, PlayerService $playerService, ClanService $clanService)
    {
        parent::__construct();
        $this->api = $api;
        $this->playerService = $playerService;
        $this->clanService = $clanService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clanTags = [];
        // $response = $this->api->searchClans([
        //     'locationId' => 57000138,
        //     'minScore'   => 40000,
        // ]);
        // $players = Player::get();
        // foreach ($response->items as $clan) {
        //     $clanTags[] = ltrim($clan->tag, '#');
        // }
        $clanTags = Cnst::CLAN_TAGS;
        $clans = Clan::whereIn('tag', $clanTags)->with('players')->get();
        foreach ($clanTags as $tag) {
            // Update Clan
            $existingClan = $clans->where('tag', $tag)->first();
            $response = $this->api->getClan($tag);
            $this->clanService->createOrUpdate($response, $existingClan);
            // $this->clanService->updateMembers($response->memberList, $players, $tag);
        }
    }
}
