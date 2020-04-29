<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $fillable = ['school_id', 'subject_id', 'teacher_id'];
}
