<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rules extends Model
{
    protected $fillable =['id','event_type','event_duration','occurence','frequency'];
    use HasFactory;
}
