<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    public $timestamps = false;
    protected $table = 'tabletopics';

    protected $fillable = [
        'id', 'topics_title', 'topics_desc', 'topics_icon', 'topics_status'
    ];
}
