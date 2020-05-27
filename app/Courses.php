<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    public $timestamps = false;
    protected $table = 'tablecourses';

    protected $fillable = [
        'id', 'category_id', 'course_avatar', 'course_title', 'course_desc', 'course_lectures', 'course_language', 'course_video', 'course_duration', 'course_includes', 'course_price', 'course_discounted_price', 'course_user_id', 'pdf', 'youtube', 'course_status'
    ];

    public function course_user() {
        return $this->belongsTo('App\User');
    }

}
