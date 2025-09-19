<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    
    protected $guarded=[];


    public function meeting()
    {
        return $this->hasOne(MeetingModel::class,"vendor_id","id");
    }
}
