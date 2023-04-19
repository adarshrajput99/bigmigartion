<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

//Fills order id using ip track and resource // Rws revison history
class resource_oid extends Controller
{
    function done(){
        $processed = DB::connection('mysql')->table('watchdogs')->where('processed','=',601)->count();
        return $processed;
    }
    function oid_ip_filler(){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
       
        $users = DB::table('ip_track')->select(['ip','oid','First seen', 'last seen'])->where('from_code','=',1)->get();

        foreach($users as $user){

        // Resource merger is a view which only for read only
        $fetch=DB::table('resource_merger')->select(['order_id','rhid'])->where('order_id','=',0)->where('ip_address','=',$user->ip)->where('created','<',$user->{'last seen'})->where('created','>',$user->{'First seen'})->get();  
            foreach($fetch as $fetchher){
                try{
                    DB::connection('mysql')->update('update watchdogs set order_id = ?,Processed = 601 where (Processed = 0 OR Processed = 400 OR Processed = 500 OR Processed = 600) and rhid=? ',[$user->oid,$fetchher->rhid]);
                }
                catch(Exception $e){
                    DB::connection('mysql')->update('update watchdogs set Processed = 600 where (Processed = 0 OR Processed = 400 OR Processed = 500 OR Processed = 600) and rhid=? ',[$user->oid,$fetchher->rhid]);
                }
            }

    }
    $end = hrtime(true);
    $duration = ($end - $start) / 1e+9;
    echo " records are done  and Time taken: {$duration} sec ";
    echo 'Total fields updated by this are :'.$this->done();
        
    }

}
