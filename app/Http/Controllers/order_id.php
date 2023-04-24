<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\String\b;


//This genrate order id by reading message
class order_id extends Controller
{
    function search_oid($oid){
       
        $from=DB::connection('mysql')->select('select id,message from watchdogs where message  like \'%'.$oid.'%\' and (Processed = 0 OR Processed = 400 OR Processed = 500) limit 500');
        $skipper=strlen($oid);
        foreach($from as $message){
            
            $positon = strpos($message->message,$oid)+$skipper;
            $check= substr($message->message,$positon,strlen($message->message)-$positon) ;
            $i=0;
            $str="";
            while($i<strlen($check)&&(ord(($check)[$i])>47 && ord(($check)[$i])<58)){
                $str=$str.$check[$i];
                $i++;
            }
            //echo $str;
            try{
                DB::connection('mysql')->update('update watchdogs set order_id = ?,Processed = 401 where id = ?',[$str,$message->id]);
            }
            catch(Exception $e){
                DB::connection('mysql')->update('update watchdogs set Processed = 400 where id = ?',[$message->id]);
               // echo "Not done ".$message->id."The check was : ".substr($message->message,strpos($message->message,$oid),$positon+40)."<br>";
            }
        }
       
       
            return ;
    }
    function done(){
        $processed = DB::connection('mysql')->table('watchdogs')->where('processed','=',401)->count();
        return $processed;
    }

    function index(){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
    
        $this->search_oid('order_id] => ');
        $this->search_oid('order_id":"');
        $this->search_oid('order_id] =>');
        $this->search_oid('Order ID - ');
        $this->search_oid('Order ID: ');
        $this->search_oid('order_id":"restolabs-');
        $this->search_oid('order_id|s:7:"');
        $this->search_oid('Order ID: ');
        $this->search_oid('order_id');
        $this->search_oid('order_id";s:7:"');
        $this->search_oid('order_id=');
        echo $this->done().": fields are Processed by order_id";

        $end = hrtime(true);
        $duration = ($end - $start) / 1e+9;
        echo " Time taken: {$duration} sec ";
    
        }
}
