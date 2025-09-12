<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollOptionModel extends Model
{
    use SoftDeletes;

    protected $table="poll_options";
    protected $guarded=[];
}
