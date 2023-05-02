<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs_rules extends Model
{
    protected $fillable = [ 'id','rule_id','rule_type','title','exec' ];
    use HasFactory;
}
