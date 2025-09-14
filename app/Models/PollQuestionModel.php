<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollQuestionModel extends Model
{
    use SoftDeletes;

    protected $table="questions";
    protected $guarded=[];

     /**
     * A question belongs to a poll
     */
    public function poll()
    {
        return $this->belongsTo(PollModel::class, 'poll_id');
    }

    /**
     * A question has many options
     */
    public function options()
    {
        return $this->hasMany(PollOptionModel::class, 'question_id');
    }

}
