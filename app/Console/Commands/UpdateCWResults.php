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
        \Log::info('start');
        $clans = [
            'GP0CL', 'PVUJQL', '209VYQ8U', 'P0GJ8JLU', 'CJP2G', 'UYYL0G', 'GL0GJU', '9900QPUP', 'RVQJPUJ', 'UVV89PL', 'UQ8VVR', '9VQPY2J8', 'VG0P2Y', 'RRVCRL9', '2LRLRVQ', '9PP9Q8YP'
        ];
        $api = new CRApi;

        foreach ($clans as $tag) {
            $response = $api->getCurrentWar($tag);
            $response2 = $api->getClan($tag);
            $clan = Clan::where('tag', $tag)->first();
            if (!$clan) {
                $clan = new Clan;
            }
            $clansScore = collect($response->clans);
            foreach ($clansScore as $score) {
                $str = $score->finishTime ?? '3000';
                if ($str !== '3000') {
                    $date = $str[0] . $str[1] . $str[2] . $str[3] . '-' . $str[4] . $str[5] . '-' . $str[6] . $str[7] . ' ' . $str[9] . $str[10] . ':' . $str[11] . $str[12] . ':' . $str[13] . $str[14];
                    $score->finishTime = $date;
                } else {
                    $score->finishTime = '3000';
                }
            }

            $array = $clansScore->sortByDesc('fame')->sortBy('finishTime');

            foreach ($clansScore as $score) {
                if ($score->finishTime === '3000') {
                    $score->finishTime = null;
                }
            } 

            $clan->current_river_race = json_encode($array);
            $clan->tag = $tag;
            $clan->cw_score = $response2->clanWarTrophies;
            $clan->title = $response->clan->name;
            $clan->save();
        }
    }
}
