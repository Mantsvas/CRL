<?php

namespace App\Console\Commands;

use App\Models\Clan;
use Illuminate\Console\Command;
use App\Http\Constants\Constants as Cnst;
use App\Models\CurrentRiverRace;
use App\Services\ClanService;
use App\Services\ClashRoyaleService as CRApi;

class UpdateCWResults extends Command
{
    private $api;
    private $clanService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateCWResults';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CRApi $api, ClanService $clanService)
    {
        parent::__construct();
        $this->api = $api;
        $this->clanService = $clanService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clans = Cnst::CLAN_TAGS;
        $riverRaces = CurrentRiverRace::whereIn('clan_tag', $clans)->get();
        foreach ($clans as $tag) {
            $data = $this->api->getCurrentRiverRace($tag);
            $this->clanService->updateCurrentRiverRace($data);
        }
    }
}
