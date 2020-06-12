<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseWithUser extends Model
{
    public $timestamps = false;
    protected $table = 'tableuserwithcourse';
    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id', 'course_id', 'user_id'
    ];

    public function course() {
        return $this->belongsTo('App\Courses');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
