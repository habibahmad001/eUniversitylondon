<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $timestamps = false;
    protected $table = 'tableresults';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'id','course_id','exam_id','user_id','result','status'
    ];
}
