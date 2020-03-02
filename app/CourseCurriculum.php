<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCurriculum extends Model
{
    public $timestamps = false;
    protected $table = 'tablecurriculum';

    protected $fillable = [
        'id','course_id','curriculum_title','curriculum_content','curriculum_status'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }
}
