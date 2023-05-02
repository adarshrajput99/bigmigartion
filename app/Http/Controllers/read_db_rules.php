<?php

namespace App\Http\Controllers;

use App\Models\rule_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Jobs\run_rules;

class read_db_rules extends Controller
{


    public function push_to_queue(){
        run_rules::dispatch();
    }

    public function mail_check(){
        $this->sendEmail('Hello ','Hi how are you');
    }
    public function sendEmail($title,$body)

    {

        $mailData = [

            'title' => $title,

            'body' => $body

        ];



        Mail::to('99adarshsingh27@gmail.com')->send(new DemoMail($mailData));


        //return;
        dd("Email is sent successfully.");

    }


    function frequency_to_minutes($frequency) {
    $minutes = 1440 / $frequency; // 1440 minutes in 24 hours
    return $minutes;
    }

    function reader(){
        echo 'here';


        $currentDateTime = now();
        $currentDateTime->setTimezone('Asia/Kolkata');
        //echo $currentDateTime->format('H:i:s');
        $processed = DB::connection('mysql')->table('rule_statuses')
            ->where('event_from', '<=', $currentDateTime->format('H:i:s'))
            ->where('event_to', '>=', $currentDateTime->format('H:i:s'))
            ->where('event_duration', '>=', $currentDateTime->toDateString())
            ->get();

        echo count($processed);
        foreach($processed as $process){
            //echo 'here';
                /* Write your command here*/

                $occurence_count = DB::connection('mysql')->table('task_types')
                ->where('title', '=', $process->title)
                ->count();

                $list=DB::connection('mysql')->table('task_types')->select('id')->where('type','=',$process->event_type)->get();
                $list_array='';
                foreach($list as $lis){
                    //echo $lis;
                    $list_array=$list_array.$lis->id.',';
                }

                $body= 'id : '.$process->id.', event_type : '.$process->event_type.', listing the id of task :'.$list_array;

                DB::table('logs_rules')->insert([
                    'rule_id' => $process->id,
                    'rule_type' => $process->event_type,
                    'exec' => $currentDateTime->format('Y-m-d H:i:s'),

                ]);
                if($occurence_count<=$process->occurence){
                    $model = rule_status::findOrFail($process->id);
                    //echo $model->event_duration;
                    $model->occurence =-1 ;
                    $model->save();
                    $this->sendEmail('An '.$process->event_type.' Has been reported need to look -ADMIN',$body);
                    DB::connection('mysql')->insert('update logs_rules set rule_id = ?,rule_type=?,exec = ?',[$process->id,$process->event_type,$currentDateTime->format('Y-m-d H:i:s')]);
                }

                echo 'Executed';


        }
    }
}
