<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public $timestamps = false;
    protected $table = 'tablecart';

    protected $fillable = [
        'id', 'session_id', 'key', 'val', 'status'
    ];
}
