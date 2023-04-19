<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Fills the resource id in the db  using message
class resource_id_finder extends Controller
{
    function search_resID($res){
        $from=DB::connection('mysql')->select('select id,message from watchdogs where message  like \'%'.$res.'%\' and rhid !=0');
        $skipper=strlen($res);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
    
        foreach($from as $message){
            
            $positon = strpos($message->message,$res)+$skipper;
            $check= substr($message->message,$positon,strlen($message->message)-$positon) ;
            $i=0;
            $str="";
            while($i<strlen($check)&&(ord(($check)[$i])>47 && ord(($check)[$i])<58)){
                $str=$str.$check[$i];
                $i++;
            }
            
            //echo $str;
            try{
                DB::connection('mysql')->update('update watchdogs set resource_id = ? where id = ?',[$str,$message->id]);
    
            }
                        
            catch(Exception $e){
                //DB::connection('mysql')->update('update watchdogs set Processed = 400 where id = ?',[$message->id]);
                echo "Not done ".$message->id."The check was : ".substr($message->message,strpos($message->message,$res),$positon+40)."<br>";
            }
        }
        $end = hrtime(true);
        $duration = ($end - $start) / 1e+9;
        echo " Time taken: {$duration} sec ";
    
            return ;
    }

    //put all updated pattern here 
    function res_id(){
        $this->search_resID('view-revision-resource/');
    }
}
