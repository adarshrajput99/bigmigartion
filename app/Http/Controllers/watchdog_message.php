<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


//Showing the message when href is clicked from nova message
class watchdog_message extends Controller
{
    function show($res_id,$opt=NULL){
        //echo $res_id;
        $data=DB::table('watchdogs')->select('message')->where('resource_id','=',$res_id)->get();
        foreach($data as $da){
            echo $da->{'message'};
        }
        
    }
}
