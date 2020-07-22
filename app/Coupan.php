<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupan extends Model
{
    protected $table = 'tablecoupans';
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'title', 'value', 'startsFrom', 'endsTo', 'ccomments', 'status'
    ];
}
