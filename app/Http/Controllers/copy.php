<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class copy extends Controller
{
function index(){
    $start = hrtime(true); 
    $offset=DB::connection('mysql2')->table('watchdogs')->count();
    $from=DB::connection('mysql')->select('select * from watchdog limit 4000 offset '.$offset);
    
    foreach($from as $field ){
        
        DB::connection('mysql2')->table('watchdogs')->insert((array)$field);
    }
    $end = hrtime(true); 
    $duration = ($end - $start) / 1e+9; 
    $offset=DB::connection('mysql2')->table('watchdogs')->count();
    echo $offset;
    echo " records are done  and Time taken: {$duration} sec ";

}
}
