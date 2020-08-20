<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    public $timestamps = false;
    protected $table = 'tableorders';
    protected $dates = ['created'];

    protected $fillable = [
        'id', 'user_id', 'key', 'val', 'order_id', 'order_items', 'order_state', 'created', 'status'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
