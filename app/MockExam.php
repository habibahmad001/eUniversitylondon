<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockExam extends Model
{
    public $timestamps = false;
    protected $table = 'tablemockexam';
    protected $dates = ['exam_date'];

    protected $fillable = [
        'id', 'course_id', 'exam_title', 'exam_content', 'exam_status', 'exam_date', 'mexam_user_id', 'ExamDuration', 'TotalMarks', 'PassingMarks'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }

    public function mexam_user() {
        return $this->belongsTo('App\User');
    }
}
