<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;
    protected $table = 'tableexam';
    protected $dates = ['exam_date'];

    protected $fillable = [
        'id', 'course_id', 'exam_title', 'exam_content', 'exam_status', 'exam_date', 'exam_user_id', 'ExamDuration', 'TotalMarks', 'PassingMarks'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }

    public function exam_user() {
        return $this->belongsTo('App\User');
    }
}
