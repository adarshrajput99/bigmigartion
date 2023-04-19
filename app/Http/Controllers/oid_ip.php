<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class oid_ip extends Controller
{
    function done(){
        $processed = DB::connection('mysql')->table('watchdogs')->where('processed','=',501)->count();
        return $processed;
    }

    //This genrate order id by tracking the ip 
    function oid_ip_filler(){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
    
        $users = DB::table('ip_track')->select(['ip','oid','First seen', 'last seen'])->get();
        $count = 0;
        foreach($users as $user){
            try{
                DB::connection('mysql')->update('update watchdogs set order_id = ?,Processed = 501 where (Processed = 0 OR Processed = 400 OR Processed = 500 OR Processed = 600) AND hostname = ? AND timestamp > ? And timestamp < ?',[$user->oid,$user->ip,$user->{'First seen'},$user->{'last seen'}]);

            }
            catch(Exception  $e){
                DB::connection('mysql')->update('update watchdogs set Processed = 500 where (Processed = 0 OR Processed = 400 OR Processed = 500 OR Processed = 600) AND hostname = ? AND timestamp > ? And timestamp < ?',[$user->ip,$user->{'First seen'},$user->{'last seen'}]);
            }
            echo 'Tried : '.$user->ip.'<br>';
        }
        echo 'Number of records updated by ip_track: '.$this->done();
        $end = hrtime(true);
        $duration = ($end - $start) / 1e+9;
        echo " Time taken: {$duration} sec ";
    
    }
}
