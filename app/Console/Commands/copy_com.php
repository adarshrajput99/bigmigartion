<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\fast_respond;
use App\Http\Controllers\processor;
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
        $object= app()->make(fast_respond::class);
        $object->index();
        $object= app()->make(processor::class);
        $object->index();
    }
}
