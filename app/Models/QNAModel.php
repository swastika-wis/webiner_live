<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QNAModel extends Model
{
    use SoftDeletes;

    protected $table="qnas";
    protected $guarded=[];

    public function askBy()
    {
        return $this->hasOne(Participent::class,"id","ask_by");
    }

}
