<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        return view('school.schoolreg');
    }

    function create()
    {
        return view('school.schoolreg');
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name'      =>  'required',
            'address'   => 'required',
            'email'     => 'email:rfc,dns'
        ]);

        $school = School::create($request->all());

        return view('auth.register', ['data' => $school]);
    }
}
