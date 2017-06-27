<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table='response';
    public $timestamps = true;
    protected $guarded = ['response_id'];

    public function response()
    {
        return $this->belongsTo(complaints::class,'complaints_id','complaint_id');
    }
}
