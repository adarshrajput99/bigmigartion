<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\copy;
class copy_server_check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:copy_server_check';

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
        $object= app()->make(copy::class);
        $object->index();
    }
}
