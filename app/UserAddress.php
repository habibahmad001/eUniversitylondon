<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public $timestamps = false;
    protected $table = 'tableuseraddress';

    protected $fillable = [
        'id', 'user_id', 'b_street_address', 'b_country', 'b_state', 'b_city', 'b_zip', 's_street_address', 's_country', 's_state', 's_city', 's_zip', 'status', 'created'
    ];

    public function User_Address() {
        return $this->belongsTo('App\User');
    }
}
