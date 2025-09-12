<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPollModel extends Model
{
    use SoftDeletes;

    protected $table="user_polls";
    protected $guarded=[];
}
