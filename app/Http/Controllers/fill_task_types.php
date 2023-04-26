<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class fill_task_types extends Controller
{
    function fill(){
        date_default_timezone_set('Asia/Kolkata');
        $date = date('m/d/Y h:i:s a', time());
        $start = hrtime(true);
    
        //'select id,order_id,processed,timestamp from watchdogs where timestamp != 0 and order_id != 0 order by timestamp  limit 4000'
        $from=DB::connection('mysql')->table('watchdogs')->select(['type','severity'])->distinct()->limit(1000)->get();
        
        foreach($from as $field ){
            $modify = array('title'=>$field->type,
                            'severity'=>$field->severity,
                            'type'=>'',
                            
                            );
            DB::connection('mysql')->table('task_types')->insert((array)$modify);
        }
        $end = hrtime(true);
        $duration = ($end - $start) / 1e+9;
        $offset=DB::connection('mysql')->table('task_types')->count();
        echo $offset;
        echo " records are done  and Time taken: {$duration} sec ";
        echo $date;
    }
}
