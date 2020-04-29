<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = [
        'nip', 'name', 'place', 'date', 'address',
        'telp1', 'telp2', 'email', 'school_id', 'user_id', 'departement', 'foto', 'status'
    ];

    public function getPhoto()
    {
        if (!$this->foto) {
            return asset('adminlte/img/no_photo.png');
        }

        return asset('adminlte/img/' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }
}
