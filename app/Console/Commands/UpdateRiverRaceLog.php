<?php

namespace App\Console\Commands;

use App\Services\ClanService;
use Illuminate\Console\Command;
use App\Http\Constants\Constants as Cnst;
use App\Services\ClashRoyaleService as CRApi;

class UpdateRiverRaceLog extends Command
{
    private $api;
    private $clanService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateRiverRaceLog';

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
        $tags = Cnst::CLAN_TAGS;

        foreach ($tags as $tag) {
            $riverRaces = $this->api->getRiverRaceLog($tag);
            foreach ($riverRaces->items as $riverRace) {
                $this->clanService->updateRiverRaceLog($riverRace);
            }
        }
        //
    }
}
