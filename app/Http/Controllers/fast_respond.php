<?php

namespace App\Http\Controllers;
use App\Jobs\fastcopy;
use App\Jobs\copy_rws;
use App\Jobs\copy_rws_watchdog;
use App\Jobs\copy_rws_resource;
use App\Jobs\copy_rws_logs;

use Illuminate\Http\Request;

class fast_respond extends Controller
{
    function index(){
        fastcopy::dispatch();
        copy_rws::dispatch();
        copy_rws_watchdog::dispatch();
        copy_rws_resource::dispatch();
        copy_rws_logs::dispatch();
    }
    }
