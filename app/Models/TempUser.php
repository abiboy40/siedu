<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    protected $fillable = ['id_number', 'name', 'email', 'address', 'place', 'date', 'parent_email', 'departement'];
}
