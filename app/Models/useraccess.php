<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class useraccess extends Model
{

    protected $fillable = ['role_id', 'menu_id', 'submenu_id'];

    public function menu()
    {
        return $this->belongsToMany('menu');
    }

    public function submenu()
    {
        return $this->belongsToMany('submenu');
    }
}
