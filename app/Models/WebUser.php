<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


// webinar users
class WebUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'web_users';   // your table name

    protected $primaryKey = 'id';     // primary key

    protected $guarded=[];

    public $timestamps = false;
}
