<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobsTable extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $table = 'jobstable';

    protected $fillable = [
        'id','category_id','job_title','job_desc','where'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function locationtable() {
        return $this->belongsTo('App\CreateLocationTable');
    }

}
