<?php

namespace App\Http\Controllers;
use App\Nova\rule_status;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Message;
//use App\Http\Controllers\read_db_rules;
class discount_check extends Controller
{
    function discount_checker($from,$to,$typex,$date){

        $type = ['Interval',
                'Total orders',
                'Orders Amount',
                'Total Coupons Applied','Total Coupon Discount',
                'Total Como Discount Applied','Total Como Discount',
                'Total Como Payment Applied','Total Como Payment',
                'Total Gift card Payment Applied','Total Gift Card Payment'];
        $from=DB::connection('mysql')->table('watchdogs')->where('updated_at','>=',$date.'00:00:00')->where('type','=','Total Coupon Discount')->limit(100)->get();
        $discount_sum=0;

        foreach($from as $one){
            if($one->type=='Total Coupon Discount'){
                $value=intval(substr($one->message,0,strlen($one->message)));
                if(value($one->message)>$from && value($one->message)<$to ){

                }
                else{
                    return true;
                }
            }
        }
        return false;
        //echo $date;

    }
}
