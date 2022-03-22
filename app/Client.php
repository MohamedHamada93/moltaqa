<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{
    use HasFactory ,Notifiable;

    protected $table = 'clients';
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'remember_token',
        'password',
    ];
}
