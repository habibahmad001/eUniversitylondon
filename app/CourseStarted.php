<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStarted extends Model
{
    public $timestamps = false;
    protected $table = 'tablecoursestarted';
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'id', 'user_id', 'course_id', 'CourseProgramID', 'CourseCompleted', 'isActive'
    ];
}
