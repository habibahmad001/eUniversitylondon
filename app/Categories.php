<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $timestamps = false;
    protected $table = 'tablecategories';

    protected $fillable = [
        'id', 'category_title', 'category_desc', 'category_status', 'category_cid', 'selectedicon', 'page_slug'
    ];
}
