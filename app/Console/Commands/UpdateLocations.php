<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ClashRoyaleService as CRApi;
use App\Services\LocationService;

class UpdateLocations extends Command
{
    private $api;
    private $locationService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateLocations';

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
    public function __construct(CRApi $api, LocationService $locationService)
    {
        parent::__construct();
        $this->api = $api;
        $this->locationService = $locationService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locations = $this->api->getLocations();

        foreach ($locations->items as $location) {
            $this->locationService->updateOrCreate($location);
        }
    }
}
