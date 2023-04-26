<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class executive extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];
    use HasFactory;
}
