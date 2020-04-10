<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name', 'address', 'email', 'telp1', 'telp2', 'fax', 'curriculum','num_of_student', 'num_of_Staff'];
}
  