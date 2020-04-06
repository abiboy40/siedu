<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class useraccess extends Model
{
    public function menu()
    {
        return $this->belongsToMany('menu');
    }

    public function submenu()
    {
        return $this->belongsToMany('submenu');
    }
}
