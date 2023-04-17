<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\String\b;

class order_id extends Controller
{
    function search_oid($oid){
        $from=DB::connection('mysql')->select('select id,message from watchdogs where message  like \'%'.$oid.'%\' and Processed = 0');
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
                DB::connection('mysql')->update('update watchdogs set order_id = ?,Processed = 1 where id = ?',[$str,$message->id]);
            }
            catch(Exception $e){
                echo "Not done ".$message->id."The check was : ".substr($message->message,strpos($message->message,$oid),$positon+40)."<br>";
            }
        }
            return ;
    }
    function done(){
        $processed = DB::connection('mysql')->table('watchdogs')->where('processed','=',1)->count();
        return $processed;
    }

    function index(){
        $this->search_oid('order_id] => ');
        $this->search_oid('order_id":"');
        $this->search_oid('order_id] =>');
        $this->search_oid('Order ID - ');
        $this->search_oid('Order ID: ');
        $this->search_oid('order_id":"restolabs-');
        $this->search_oid('order_id|s:7:"');
        $this->search_oid('Order ID: ');
        $this->search_oid('order_id');

        echo $this->done().": fields are Processed";
        }

}
