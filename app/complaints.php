<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class complaints extends Model
{
    protected $table='complaints';
    public $timestamps=true;
    protected $fillable = [
        'complaint_subject','complaint_text','user_id','create_by'
    ];
    public function responses()
    {
        return $this->hasMany(Response::class,'complaint_id','complaints_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
