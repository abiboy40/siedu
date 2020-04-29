<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function GuzzleHttp\Promise\all;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->is_active == 0) {
            return redirect('logout');
        }

        if (Auth::user()->is_active == 0) {
            return redirect('logout');
        }

        return view('admin.dashboard');
    }

    public function profile($id)
    {
        $role = Auth::user()->role_id;
        // dd($role);
        if ($role == 2 || $role == 3 || $role == 5) {
            $data = User::find($id)->teacher;
            return view('/profile', compact('data'));
        }

        return redirect('/student');
    }
}
