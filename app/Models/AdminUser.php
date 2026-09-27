<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'bh_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $guarded = [];
}
