<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearTusCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tus:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the tus cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo shell_exec('./vendor/bin/tus tus:expired');
    }
}
