<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Submenu;
use App\Models\useraccess;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = role::find($id);
        $submenu = DB::table('useraccesses')
            ->join('submenus', 'useraccesses.submenu_id', '=', 'submenus.id')
            ->select('useraccesses.role_id', 'submenus.name', 'submenus.icon', 'submenus.url', 'useraccesses.id')
            ->where('submenus.is_active', '=', 1)
            ->where('useraccesses.role_id', '=', $id)->get();
        $allmenu = Submenu::where('is_active', 1)->get();

        return view('admin.editaccess', ['data' => $data, 'menu' => $submenu, 'allmenu' => $allmenu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deactivated($id)
    {
        Role::where('id', $id)->update(['is_active' => 0]);
        return back();
    }

    public function activated($id)
    {
        Role::where('id', $id)->update(['is_active' => 1]);
        return back();
    }
}
