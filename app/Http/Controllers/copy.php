<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class copy extends Controller
{
function index(){
    $offset=DB::connection('mysql2')->table('watchdogs')->count();
    $from=DB::connection('mysql')->select('select * from watchdog limit 1000 offset '.$offset);
    
    foreach($from as $field ){
        
        DB::connection('mysql2')->table('watchdogs')->insert((array)$field);
    }
    echo $offset;
}
}
