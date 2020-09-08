<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public $timestamps = false;
    protected $table = 'tablequiz';
    protected $dates = ['exam_date'];

    protected $fillable = [
        'id', 'course_id', 'quiz_title', 'quiz_content', 'quiz_status', 'quiz_date', 'quiz_user_id'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }

    public function quiz_user() {
        return $this->belongsTo('App\User');
    }
}
