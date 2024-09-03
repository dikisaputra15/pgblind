<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Socialconflict extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runsocialconflict';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'socialconflict added';

    /**
     * Execute the console command.
     */

     public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://online.code69.my.id/socialconflict');

        if ($response->successful()) {
            $this->info('Social Conflict accessed successfully.');
        } else {
            $this->error('Failed to access Social Conflict.');
        }
    }
}
