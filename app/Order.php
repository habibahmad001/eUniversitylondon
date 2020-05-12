<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'tableorders';

    protected $fillable = [
        'id', 'user_id', 'key', 'val', 'order_id', 'order_items', 'order_state', 'created', 'status'
    ];

    public function User_Order() {
        return $this->belongsTo('App\User');
    }
}
