<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function Student()
    {
        return $this->belongsToMany('App\Models\Student')->withPivot(['score']);
    }
}
