<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rule_status extends Model
{
    protected $fillable = ['id','event_type','title','event_duration','occurence','frequency','last_executed'];
    use HasFactory;
}
