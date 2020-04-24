<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MexamWithUser extends Model
{
    public $timestamps = false;
    protected $table = 'tablemexamwithuser';

    protected $fillable = [
        'id', 'mexam_id', 'user_id'
    ];

    public function mexam() {
        return $this->belongsTo('App\MockExam');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
