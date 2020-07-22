<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'tablecomments';
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'name', 'email', 'subComment', 'message', 'liked', 'isActive', 'status'
    ];
}
