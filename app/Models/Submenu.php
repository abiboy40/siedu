<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $fillable = ['name', 'menu_id', 'url'];

    public function menu()
    {
        return $this->belongsTo('App\Models\menu');
    }

    public function useraccess()
    {
        return $this->hasMany('useraccess');
    }
}
