<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = ['name', 'email', 'school_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
