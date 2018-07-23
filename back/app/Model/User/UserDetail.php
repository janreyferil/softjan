<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $fillable = [
      'user_detail_id', 'user_id', 'subject_id','first_name','last_name',
      'age','address','contact','status'
    ];
}
