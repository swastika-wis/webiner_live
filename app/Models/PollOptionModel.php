<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollOptionModel extends Model
{
    use SoftDeletes;

    protected $table="options";
    protected $guarded=[];

    public function question()
    {
        return $this->belongsTo(PollQuestionModel::class, 'question_id');
    }
}
