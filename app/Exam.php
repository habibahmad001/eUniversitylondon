<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;
    protected $table = 'tableexam';

    protected $fillable = [
        'id', 'course_id', 'exam_title', 'exam_content', 'exam_status', 'exam_eid'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }
}
