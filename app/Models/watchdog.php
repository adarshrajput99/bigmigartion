<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class watchdog extends Model
{
    use HasFactory;

    protected $fillable =['wid','uid','type','message','variable','severity','link','location','referer','hostname','timestamp','Processed
','order_id'];
}
