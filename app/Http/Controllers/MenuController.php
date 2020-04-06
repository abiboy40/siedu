<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\useraccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // public function index()
    // {
    //     $Data['menu'] = DB::table('menus')
    //         ->join('useraccesses', 'menus.id', '=', 'useraccesses.menu_id')
    //         ->select('menus.name')
    //         ->where('useraccesses.role_id', '=', Auth::user()->role_id)->distinct()->get();

    //     return view('layouts.main', $Data);
    // }
}
