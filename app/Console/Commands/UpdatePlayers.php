<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ClashRoyaleService as CRApi;
use App\Models\Player;
use Carbon\Carbon;

class UpdatePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePlayers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $api;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->api = new CRApi;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now();
        $players = Player::whereNotNull('tag')->get();

        foreach ($players as $player) {
            $apiData = $this->api->getPlayer($player->tag);

           \Log::debug(json_encode($player));
           \Log::debug(json_encode($apiData->bestTrophies));
            $player->max_trophies = $apiData->bestTrophies;
        }
    }
}
