<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// this class fills the ip table from watchdogs record 

class ip_filler extends Controller
{
    function finder($ip){
        $users = DB::table('ip_track')->select('id')
            ->where('ip', $ip)->exists();

        return $users;
    }
    function order_id_finder($oid){
        $users = DB::table('ip_track')->select('oid')
            ->where('oid', $oid)->exists();

        return $users;
    }
    function created_compare($oid,$timestamp){
        $ip_tacking = DB::table('ip_track')->select('First seen','last seen')
            ->where('oid', $oid)->first( );
        if($timestamp>$ip_tacking->{'last seen'}){
            return 0; //update the last seen 
        }
        if($timestamp<$ip_tacking->{'First seen'}){
            return 1;//update firstseen
        }
    }
    
    function filler(){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
    
        //'select id,order_id,processed,timestamp from watchdogs where timestamp != 0 and order_id != 0 order by timestamp  limit 4000'
        $from=DB::connection('mysql')->table('watchdogs')->where('timestamp','!=',0)->where('order_id','!=',0)->get();
        //$from_ip=DB::connection('mysql')->select('select * from    order by timestamp desc limit 4000');
        $count =0;
        foreach($from as $field){
            if($this->finder($field->hostname)){
                if($this->order_id_finder($field->order_id)){
                    if(!$this->created_compare($field->order_id,$field->timestamp))
                    DB::table('ip_track')
                        ->where('oid', $field->order_id)
                        ->update(['last seen' =>$field->timestamp]);
                    else if($this->created_compare($field->order_id,$field->timestamp))
                    DB::table('ip_track')
                        ->where('oid', $field->order_id)
                        ->update(['First seen' =>$field->timestamp]);


                }
                else{
                    
                    DB::table('ip_track')->insert(['ip'=>$field->hostname,
                                                'oid'=>$field->order_id,
                                                'First seen'=>$field->timestamp,
                                                'last seen'=>$field->timestamp,
                                                'processed'=>0]);
                }
            }
            else {
                
                DB::table('ip_track')->insert(['ip'=>$field->hostname,
                                                'oid'=>$field->order_id,
                                                'First seen'=>$field->timestamp,
                                                'last seen'=>$field->timestamp,
                                                'processed'=>0]);
            }
                $count++;
        }
        $end = hrtime(true);
        $duration = ($end - $start) / 1e+9;
        echo " Time taken: {$duration} sec ";
    
        echo $count;

    }
    function fill_ip_from_resource(){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
    
        $from=DB::connection('mysql')->table('resource_merger')->where('order_id','!=',0)->get();
        //$from_ip=DB::connection('mysql')->select('select * from    order by created desc limit 4000');
        $count =0;
        foreach($from as $field){
            if($this->finder($field->ip_address)){
                if($this->order_id_finder($field->order_id)){
                    if(!$this->created_compare($field->order_id,$field->created))
                    DB::table('ip_track')
                        ->where('oid', $field->order_id)
                        ->update(['last seen' =>$field->created]);
                    else if($this->created_compare($field->order_id,$field->created))
                    DB::table('ip_track')
                        ->where('oid', $field->order_id)
                        ->update(['First seen' =>$field->created]);


                }
                else{
                    
                    DB::table('ip_track')->insert(['ip'=>$field->ip_address,
                                                'oid'=>$field->order_id,
                                                'First seen'=>$field->created,
                                                'last seen'=>$field->created,
                                                'processed'=>0,
                                                'from_code'=>1]);
                }
            }
            else {
                
                DB::table('ip_track')->insert(['ip'=>$field->ip_address,
                                                'oid'=>$field->order_id,
                                                'First seen'=>$field->created,
                                                'last seen'=>$field->created,
                                                'processed'=>0,
                                                'from_code'=>1]);
            }
                $count++;
        }
        $end = hrtime(true);
        $duration = ($end - $start) / 1e+9;
        echo " Time taken: {$duration} sec ";
    
        echo $count;



    }

    
}
