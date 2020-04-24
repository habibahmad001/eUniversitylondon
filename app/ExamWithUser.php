<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamWithUser extends Model
{
    public $timestamps = false;
    protected $table = 'tableexamwithuser';

    protected $fillable = [
        'id', 'exam_id', 'user_id'
    ];

    public function exam() {
        return $this->belongsTo('App\Exam');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
