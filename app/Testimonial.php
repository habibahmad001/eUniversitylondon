<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public $timestamps = false;
    protected $table = 'tabletestimonial';

    protected $fillable = [
        'id','testimonial_name','testimonial_desc','testimonial_role','testimonial_img','testimonial_status', 'created_at', 'updated_at'
    ];
}
