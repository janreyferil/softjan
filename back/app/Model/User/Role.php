<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  
    protected $fillable = [
       'role_id', 'name'
    ];

}
