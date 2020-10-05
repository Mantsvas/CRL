<?php

namespace App\Console\Commands;

use App\Models\Clan;
use Illuminate\Console\Command;
use App\Services\ClashRoyaleService as CRApi;

class UpdateCWResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateCW';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clans = [
            'GP0CL', 'PVUJQL', '209VYQ8U', 'P0GJ8JLU', 'CJP2G', 'UYYL0G', 'GL0GJU', '9900QPUP', 'RVQJPUJ', 'UVV89PL', 'UQ8VVR'
        ];
        $api = new CRApi;

        foreach ($clans as $tag) {
            $response = $api->getCurrentWar($tag);
            $clan = Clan::where('tag', $tag)->first();
            if (!$clan) {
                $clan = new Clan;
            }

            $array = collect($response->clans)->sortByDesc('fame');
            $clan->current_river_race = json_encode($array);
            $clan->tag = $tag;
            $clan->cw_score = $response->clan->clanScore;
            $clan->title = $response->clan->name;
            $clan->save();
        }
    }
}
