<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermAndServices extends Model
{
    public $timestamps = false;
    protected $table = 'tabletermandservices';

    protected $fillable = [
        'id', 'termandservices_title', 'termandservices_desc', 'termandservices_status'
    ];
}
