<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function GuzzleHttp\Promise\all;
use App\Models\Role;
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
        return view('admin.dashboard');
    }

    public function staff()
    {
        return view('school.teacher');
    }

    public function profile($id)
    {
        $role = Auth::user()->role_id;
        // dd($role);
        if ($role == 1) {
            $data = User::find($id);
            return view('/profile', ['data' => $data]);
        } elseif ($role == 2 || $role == 3 || $role == 5) {
            return Redirect('/teacher/' . $id);
        }

        return redirect('/student/$id');
    }
}
