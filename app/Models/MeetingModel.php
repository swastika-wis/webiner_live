<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingModel extends Model
{
    use SoftDeletes;

    protected $table="meetings";
    protected $guarded=[];

    public function vendorRecord()
    {
        return $this->hasOne(Vendor::class,"id","vendor_id");
    }
}
