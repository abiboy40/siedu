<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function submenu()
    {
        return $this->hasMany('App\Models\submenu');
    }

    public function useraccess()
    {
        return $this->hasMany('useraccess');
    }
}
