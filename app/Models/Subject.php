<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['subject'];

    public function Student()
    {
        return $this->belongsToMany(Student::class)->withPivot(['score']);
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
