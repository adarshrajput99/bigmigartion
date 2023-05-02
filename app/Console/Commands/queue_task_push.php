<?php

namespace App\Console\Commands;

use App\Http\Controllers\read_db_rules;
use Illuminate\Console\Command;

class queue_task_push extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:queue_task_push';

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
        $object= app()->make(read_db_rules::class);
        $object->push_to_queue();
    }
}
