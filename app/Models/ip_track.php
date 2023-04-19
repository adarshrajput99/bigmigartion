<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ip_track extends Model
{
    protected $fillable = ['id','ip','order_id','first_seen','last-seen','processed','time_stamp'];
    use HasFactory;
}
