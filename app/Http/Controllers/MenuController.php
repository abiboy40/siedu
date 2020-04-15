<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\useraccess;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::all();

        return view('admin.menu', ['menu' => $data]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->Validated([
            'name' => 'required',
            'menu_id' => 'required',
            'url' => 'required'
        ]);

        Submenu::create($request->all);
    }

    public function show($id)
    {
        $current = Menu::find($id);
        $data = DB::table('menus')
            ->join('submenus', 'submenus.menu_id', '=', 'menus.id')
            ->select('submenus.id', 'submenus.name', 'submenus.is_active')
            ->where('menus.id', '=', $id)->get();
        // dd($data);        
        return view('admin.editmenu', ['menu' => $current, 'submenu' => $data]);
    }

    public function activated($id)
    {
        Menu::where('id', $id)
            ->update(['is_active' => 1]);

        return back()->with('status', 'Menu Activated!!');
    }

    public function deactivated($id)
    {
        Menu::where('id', $id)
            ->update(['is_active' => 0]);

        return back()->with('status', 'Menu Deactivated!!');
    }
}
