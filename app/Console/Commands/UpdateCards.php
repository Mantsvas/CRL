<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CardService;
use CRApi;

class UpdateCards extends Command
{
    private $api;
    private $cardService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateCards';

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
    public function __construct(CRApi $api, CardService $cardService)
    {
        parent::__construct();
        $this->api = $api;
        $this->cardService = $cardService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->api->getCards();
        foreach ($data->items as $card) {
            $this->cardService->updateOrCreate($card);
        }
    }
}
