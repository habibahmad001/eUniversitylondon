<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;
    protected $table = 'tablestate';

    protected $fillable = [
        'id', 'state_name', 'cid', 'status', 'created'
    ];

    public function country_state() {
        return $this->belongsTo('App\Country');
    }
}
