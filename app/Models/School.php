<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    protected $fillable = [
        'name', 'address', 'telp1', 'telp2', 'fax', 'email', 'curriculum',
        'num_of_student', 'num_of_staff'
    ];
}
