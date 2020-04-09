<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public $timestamps = false;
    protected $table = 'tableassignment';

    protected $fillable = [
        'id','exam_id','assignment_title','assignment_file','table_name', 'assignment_status'
    ];
}
