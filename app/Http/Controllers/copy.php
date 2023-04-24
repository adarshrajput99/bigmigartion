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

//copy from watchdogs
function index(){
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $start = hrtime(true);
    $offset=DB::connection('mysql')->table('watchdogs')->max('wid');
    if($offset == NULL){
        $offset =0;
    }
    $from=DB::connection('mysql2')->select('select * from watchdog where wid > '.$offset.' limit 4000 ');

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

//copy from rws_revison-history
function copy2(){
    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $start = hrtime(true);
    $offset=DB::connection('mysql')->table('watchdogs')->max('rhid');
    if($offset == NULL){
        $offset =0;
    }
    echo $offset;
    
    $from=DB::connection('mysql2')->select('select * from rws_revision_history where rhid > '.$offset.' limit 4000 ');

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

//copy resource from remote
function copy3(){
    
     date_default_timezone_set('Asia/Kolkata');
     $date = date('m/d/Y h:i:s a', time());
     $start = hrtime(true);
     $offset=DB::connection('mysql')->table('resources')->max('resource_id');
     if($offset == NULL){
        $offset =0;
    }
     $from=DB::connection('mysql2')->select('select * from rws_revision_history_resource where resource_id > '.$offset.' limit 4000 ');
 
     foreach($from as $field ){
         $modify = array('resource_id'=>$field->resource_id,
                         'resource'=>$field->resource,
                         'referer'=>$field->referer,
                         'location'=>$field->location,
                         'ip_address'=>$field->ip_address,
                         'created'=>$field->created,
                         );
         DB::connection('mysql')->table('resources')->insert((array)$modify);
     }
     $end = hrtime(true);
     $duration = ($end - $start) / 1e+9;
     $offset=DB::connection('mysql')->table('resources')->count();
     echo $offset;
     echo " records are done  and Time taken: {$duration} sec ";
     echo $date;
 
 
}

//copy rws_logs
function copy4(){
    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $start = hrtime(true);
    $max_entry=DB::connection('mysql')->table('watchdogs')->max('lid');
    //echo 'Max entry is :'.$max_entry;
    if($max_entry == NULL){
        $max_entry =0;
    }
    $from=DB::connection('mysql2')->select('select * from rws_logs where lid >'.$max_entry. ' limit 4000 ');

    foreach($from as $field ){
        $modify = array('lid'=>$field->lid,
                        'profile_id'=>$field->profile_id,
                        'location_id'=>$field->location_id,
                        'uid'=>$field->uid,
                        'entity_id'=>$field->entity_id,
                        'type'=>$field->type,
                        'type_key'=>$field->type_key,
                        'event_type'=>$field->event_type,
                        'message'=>$field->message,
                        'location'=>$field->location,
                        'hostname'=>$field->hostname,
                        'timestamp'=>$field->timestamp,
                        );
        DB::connection('mysql')->table('watchdogs')->insert((array)$modify);
    }
    $end = hrtime(true);
    $duration = ($end - $start) / 1e+9;
    $offset=DB::connection('mysql')->table('watchdogs')->where('lid','!=',0)->count();
    echo $offset;
    echo " records are done  and Time taken: {$duration} sec ";
    echo $date;


}
//copy rws watchdog
function copy5(){
    date_default_timezone_set('Asia/Kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $start = hrtime(true);
    $max_entry=DB::connection('mysql')->table('watchdogs')->max('rec_id');
    if($max_entry == NULL){
        $max_entry =0;
    }
    
    $from=DB::connection('mysql2')->select('select * from rws_watchdog where rec_id >'.$max_entry. ' limit 4000 ');

    foreach($from as $field ){
        $modify = array('rec_id'=>$field->rec_id,
                        'type'=>$field->type,
                        'message'=>$field->data,
                        'date_updated'=>$field->date_updated,
                        );
        DB::connection('mysql')->table('watchdogs')->insert((array)$modify);
    }
    $end = hrtime(true);
    $duration = ($end - $start) / 1e+9;
    $offset=DB::connection('mysql')->table('watchdogs')->where('rec_id','!=',0)->count();
    echo $offset;
    echo " records are done  and Time taken: {$duration} sec ";
    echo $date;


}
}
