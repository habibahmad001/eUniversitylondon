<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    public $timestamps = false;
    protected $table = 'tableteams';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'id','teams_name','teams_desc','teams_role','teams_img','teams_status', 'created_at', 'updated_at'
    ];
}
