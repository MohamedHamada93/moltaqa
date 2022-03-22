<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'remember_token',
        'password',
    ];
}
