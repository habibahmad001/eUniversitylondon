<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseProgram extends Model
{
    public $timestamps = false;
    protected $table = 'tablecourseprogram';
    protected $dates = ['created'];

    protected $fillable = [
        'id', 'course_id', 'cp_title', 'cp_author', 'cp_desc', 'cp_placement', 'cp_status', 'created', 'videoLink', 'doc', 'OtherData'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }
}
