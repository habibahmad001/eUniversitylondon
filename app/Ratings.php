<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table = 'tablerating';
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'course_id', 'user_id', 'rating', 'ccomment', 'commentlevel', 'status'
    ];
}
