<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Writer;

class copy extends Controller
{
function time_max(){
    $lastInsertTime = DB::connection('mysql')->table('watchdogs')->max('updated_at');
    return $lastInsertTime;
}

function index(){
    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $start = hrtime(true);
    $offset=DB::connection('mysql')->table('watchdogs')->where('wid','!=',0)->count();
    $from=DB::connection('mysql2')->select('select * from watchdog limit 4000 offset '.$offset);

    foreach($from as $field ){

        DB::connection('mysql')->table('watchdogs')->insert((array)$field);
    }
    $end = hrtime(true);
    $duration = ($end - $start) / 1e+9;
    $offset=DB::connection('mysql')->table('watchdogs')->count();
    echo $offset;
    echo " records are done  and Time taken: {$duration} sec ";
    echo $date;
}

function copy2(){
    #echo "in copy 2";
    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $start = hrtime(true);
    $offset=DB::connection('mysql')->table('watchdogs')->where('rhid','!=',0)->count();
    $from=DB::connection('mysql2')->select('select * from rws_revision_history limit 4000 offset '.$offset);

    foreach($from as $field ){
        $modify = array('rhid'=>$field->rhid,
                        'profile_id'=>$field->profile_id,
                        'uid'=>$field->uid,
                        'entity_id'=>$field->entity_id,
                        'message'=>$field->message,
                        'created'=>$field->created,
                        'type'=>$field->log_type,
                        'severity'=>$field->log_severity,
                        'order_id'=>$field->order_id,
                        'service_type'=>$field->service_type);
        DB::connection('mysql')->table('watchdogs')->insert((array)$modify);
    }
    $end = hrtime(true);
    $duration = ($end - $start) / 1e+9;
    $offset=DB::connection('mysql')->table('watchdogs')->count();
    echo $offset;
    echo " records are done  and Time taken: {$duration} sec ";
    echo $date;

}
}
