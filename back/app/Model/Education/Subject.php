<?php

namespace App\Model\Education;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
    protected $fillable = [
       'subject_id', 'name'
    ];
}
