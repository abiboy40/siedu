<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    public function menu()
    {
        return $this->belongsTo('App\Models\menu');
    }

    public function useraccess()
    {
        return $this->hasMany('useraccess');
    }
}
