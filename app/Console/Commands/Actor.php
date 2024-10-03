<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Actor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runactor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'actor added';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://pg.code69.my.id/actor');

        if ($response->successful()) {
            $this->info('Actor accessed successfully.');
        } else {
            $this->error('Failed to access Actor.');
        }
    }
}
