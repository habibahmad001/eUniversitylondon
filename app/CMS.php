<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    public $timestamps = false;
    protected $table = 'tablecms';

    protected $fillable = [
        'id', 'cms_title', 'cms_desc', 'cms_status', 'cms_pid'
    ];
}
