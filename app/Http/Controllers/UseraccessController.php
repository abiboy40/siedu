<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\useraccess;
use Illuminate\Support\Facades\Redirect;

class UseraccessController extends Controller
{
    public function store(Request $request)
    {
        // return $request;
        $result = Useraccess::where(['role_id' => request('roleid'), 'submenu_id' => request('menulist')])->get();
        // dd($result);
        if ($result->count() > 0) {
            return Redirect()->route('editaccess', request('roleid'))->with('status', 'Menu Already Have!');
            // return $result->count();
        } else {
            Useraccess::create([
                'role_id' => request('roleid'),
                'submenu_id' => request('menulist')
            ]);
            return Redirect()->route('editaccess', request('roleid'))->with('status', 'Menu Successfully Added!!');
        }
    }

    public function destroy($id)
    {
        useraccess::destroy($id);
        return Redirect()->back()->with('status', 'Menu Successfully Deleted!!');
    }
}
