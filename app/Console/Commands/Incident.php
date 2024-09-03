<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Incident extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runincident';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'incident added';

    /**
     * Execute the console command.
     */

     public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://online.code69.my.id/incidenttype');

        if ($response->successful()) {
            $this->info('Incident accessed successfully.');
        } else {
            $this->error('Failed to access Incident.');
        }
    }
}
