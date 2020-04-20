<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id', 'nis', 'name', 'place_of_bith', 'date_of_birth', 'address', 'student_email',
        'parent_email', 'grade'
    ];


    public function subject()
    {
        return $this->belongsToMany('App\Models\Subject')->withPivot(['score']);
    }
}
