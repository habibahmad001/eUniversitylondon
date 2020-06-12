<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $table = 'tablecountry';
    protected $dates = ['created'];

    protected $fillable = [
        'id', 'country_name', 'status', 'created'
    ];
}
