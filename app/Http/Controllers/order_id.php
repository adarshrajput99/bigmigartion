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
        $from=DB::connection('mysql2')->select('select wid,message from watchdogs where message  like \'%'.$oid.'%\' and Processed = 0 limit  100');
        $skipper=strlen($oid);
        foreach($from as $message)
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
                DB::connection('mysql2')->update('update watchdogs set order_id = ?,Processed = 1 where wid = ?',[$str,$message->wid]);
            }
            catch(Exception $e){
                echo "Not done ".$message->wid."<br>";
            }
            return ;
    }

    function index(){
        $from=DB::connection('mysql2')->select('select wid,message from watchdogs where message  like \'%order_id%\' and Processed = 0 limit  100');
        
        $search='order_id';
        foreach($from as $message){
            $pos = strpos($message->message,$search);
            $check= substr($message->message,$pos+13,strlen($message->message)-($pos+13)) ;
            //echo $message->message;
            $i=0;
            $str="";
            // $check;
            //echo ord(($check)[$i]);
            while($i<strlen($check)&&(ord(($check)[$i])>47 && ord(($check)[$i])<58)){
                $str=$str.$check[$i];
                $i++;
//break;
            }
            //echo $str;
            if(strlen($check)!=0){
                try{
                    DB::connection('mysql2')->update('update watchdogs set order_id = ?,Processed = 1 where wid = ?',[$str,$message->wid]);
                }
                catch(Exception $e){
                    $o = new order_id();
                    if(strpos($message->message,'Order ID - ')){
                        $o->search_oid('Order ID - ');
                    }
                    else if(strpos($message->message,'Order ID: ')){
                        $o->search_oid('Order ID: ');
                    }
                    else if(strpos($message->message,'order_id":"restolabs-')){
                        $o->search_oid('order_id":"restolabs-');
                    }
                    else if(strpos($message->message,'order_id|s:7:"')){
                        $o->search_oid('order_id|s:7:"');
                    }
                    else{
                        DB::connection('mysql2')->update('update watchdogs set Processed = 1 where wid = ?',[$message->wid]);
                    echo '<br>Some error might be there or unidentified patter on wid '.$message->wid.' The check was :: '.substr($message->message,$pos,$pos+40)."<br><br><br>";
                    //echo '\n'.$e;
                    }
                    
                }
            }
            
           // break;
        }
        DB::connection('mysql2')->update('update watchdogs set processed =1 where message  Not like \'%order_id%\'');   
        $done=DB::connection('mysql2')->table('watchdogs')->where('processed','=','1')->count();
        echo  '<br>'.$done.' Order id are done';
        echo '<br>'.'done'; 
    }

    
}
