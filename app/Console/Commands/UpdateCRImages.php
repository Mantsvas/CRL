<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class UpdateCRImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateCRImages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get clan badges from doc.apiwar.com';

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
        for ($i = 16000000; $i < 16000180; $i++) {
            $url = 'https://docs.apiwar.com/ups/uploads/' . $i . '.png';
            $content = file_get_contents($url);
            $name = 'images/clan_badges/clan_badge_' . $i . '.png';
            Storage::disk('public')->put($name, $content);
        }

        for ($i = 0; $i < 23; $i++) {
            $url = 'https://docs.apiwar.com/ups/uploads/Arena-' . $i . '.png';
            $content = file_get_contents($url);
            $name = 'images/arena_badges/arena_' . (54000000 + $i - 1) . '.png';
            Storage::disk('public')->put($name, $content);
        }
    }
}
