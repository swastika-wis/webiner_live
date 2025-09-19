<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollModel extends Model
{
    use SoftDeletes;

    protected $table="polls";
    protected $guarded=[];

    public function options()
    {
        return $this->hasMany(PollOptionModel::class,"poll_id","id");
    }


    public function questions()
    {
        return $this->hasMany(PollQuestionModel::class, 'poll_id');
    }

    public function meeting()
    {
        return $this->hasOne(MeetingModel::class,"meeting_number","meeting_number");
    }

}
