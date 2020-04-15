<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(request());
        if ($request->has('search')) {
            $data = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->select('users.id', 'users.name', 'users.email', 'roles.role_name', 'users.is_active')
                ->where('name', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $data = DB::table('users')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->select('users.id', 'users.name', 'users.email', 'roles.role_name', 'users.is_active')->get();
        }

        return view('admin.user', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $role = Role::all();
        return view('admin.useredit', ['data' => $data, 'role' => $role]);
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
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'role' => 'required',
            'isactive' => 'required',
        ]);

        User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'is_active' => $request->isactive
            ]);

        return redirect('/user')->with('status', 'Data Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->role_id == 2 || $user->role_id == 3 || $user->role_id == 5) {
            Teacher::where('user_id', $id)->delete();
            User::destroy($id);
            return back()->with('status', 'User has been deleted!');
        } elseif ($user->role_id == 4) {
            Student::where('user_id', $id)->delete();
            User::destroy($id);
            return back()->with('status', 'User has been deleted!');
        }

        User::destroy($id);
        return back()->with('status', 'User has been deleted!');
    }
}
