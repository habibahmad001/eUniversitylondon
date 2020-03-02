<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    public $timestamps = false;
    protected $table = 'tablecourses';

    protected $fillable = [
        'id','category_id','course_curriculum_id','course_title','course_desc','created_company','what_you_learn','course_includes','course_requirements','course_for','course_price','course_discounted_price','course_status'
    ];

    public function category() {
        return $this->belongsTo('App\Categories');
    }

    public function course_curriculum() {
        return $this->belongsTo('App\CourseCurriculum');
    }
}