<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class executive extends Model
{
    protected $fillable =[
        'id','name'
    ];
    use HasFactory;
}
