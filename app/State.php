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

    public function cid() {
        return $this->belongsTo('App\Country', 'cid');
    }
}
