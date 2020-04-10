<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function profile($id)
    {
        // $data = DB::table('teachers')
        //     ->where('user_id', '=', $id)->get();
        $data = User::find($id)->teacher;
        // dd($data);
        return view('/profile', ['data' => $data]);
    }
}
