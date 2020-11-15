<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Services\ClashRoyaleService as CRApi;
use App\Services\PlayerService;
use Illuminate\Console\Command;

class UpdatePlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdatePlayers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $api;
    protected $playerService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CRApi $api, PlayerService $playerService)
    {
        parent::__construct();
        $this->api = $api;
        $this->playerService = $playerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $players = Player::where('bestTrophies', null)->with('cards')->get();
        foreach ($players as $player) {
            $data = $this->api->getPlayer($player->tag);
            $this->playerService->createOrUpdate($data, $player);
            if ($data->expLevel > 11) {
                $this->playerService->updateCards($player, $data->cards);
            }
        }
    }
}
