<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class Tanggal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:runtanggal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tanggal added';

    /**
     * Execute the console command.
     */

     public function __construct()
     {
         parent::__construct();
     }

    public function handle()
    {
        $response = Http::get('https://pg.code69.my.id/tanggal');

        if ($response->successful()) {
            $this->info('Tanggal accessed successfully.');
        } else {
            $this->error('Failed to access tanggal.');
        }
    }
}
