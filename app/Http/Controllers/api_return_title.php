<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class api_return_title extends Controller
{
    static function get_title($type){
        $processed = DB::connection('mysql')->table('task_types')->where('type', '=', 'Important')->pluck('title')->toArray();

        return $processed;
    }
}
