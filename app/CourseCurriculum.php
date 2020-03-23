<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCurriculum extends Model
{
    public $timestamps = false;
    protected $table = 'tablecurriculum';

    protected $fillable = [
        'id','course_id','curriculum_title','curriculum_content','curriculum_status', 'curriculum_user_id'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }

    public function curriculum_user() {
        return $this->belongsTo('App\User');
    }
}
