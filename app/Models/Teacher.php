<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = ['name', 'email', 'school_id', 'user_id', 'departement', 'foto'];

    public function getPhoto()
    {
        if (!$this->foto) {
            return asset('adminlte/img/no_photo.png');
        }

        return asset('adminlte/img/' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function school()
    {
        return $this->belongsTo('App\Models\School');
    }
}
