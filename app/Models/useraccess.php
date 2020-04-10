<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class useraccess extends Model
{

    protected $fillable = ['role_id', 'submenu_id'];

    public function submenu()
    {
        return $this->belongsToMany('submenu');
    }
}
