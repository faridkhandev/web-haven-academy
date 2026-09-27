<?php

namespace App\\Models;

use Illuminate\\Database\\Eloquent\\Model;

class Student extends Model
{
    protected $table = 'bh_student';

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'student_status' => 'integer',
        'student_delete_status' => 'integer',
        'link_user_id' => 'integer',
    ];

    public $timestamps = false;
}
