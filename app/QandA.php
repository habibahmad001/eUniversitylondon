<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QandA extends Model
{
    public $timestamps = false;
    protected $table = 'tableqanda';

    protected $fillable = [
        'id', 'qa_title', 'qa_desc', 'qa_status', 'qa_cid', 'exam_qa_id', 'table_name', 'qa_user_id', 'AnsType'
    ];
}
