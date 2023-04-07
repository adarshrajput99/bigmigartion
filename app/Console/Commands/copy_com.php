<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\copy;
class copy_com extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:copy_com';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $x = new copy();
        $response=$x->call('index',[]);
    }
}
