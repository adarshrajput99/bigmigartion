<?php

namespace App\Http\Controllers;

use App\Jobs\ip_filler_resource;
use App\Jobs\ip_filler2;
use App\Jobs\order_id_ip;
use App\Jobs\order_id_message;
use App\Jobs\res_id_find;

use Illuminate\Http\Request;

class processor extends Controller
{
    
    function index(){
        
        res_id_find::dispatch();
        ip_filler_resource::dispatch();
        ip_filler2::dispatch();
        order_id_message::dispatch();
        order_id_ip::dispatch();
        
    }
}
