<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public $timestamps = false;
    protected $table = 'tableclient';

    protected $fillable = [
        'id','client_name','client_logo','client_status', 'created_at', 'updated_at'
    ];
}
