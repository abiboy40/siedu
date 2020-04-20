<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id', 'user_id', 'nis', 'name', 'place_of_birth', 'date_of_birth', 'address', 'student_email',
        'father_name', 'mother_name', 'parent_email', 'foto', 'grade'
    ];


    public function subject()
    {
        return $this->belongsToMany('App\Models\Subject')->withPivot(['score']);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
