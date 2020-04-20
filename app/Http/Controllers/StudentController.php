<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $data = Student::all();
            return view('school.student', compact('data'));
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 5) {
            $schoolId = User::find(Auth::user()->id)->teacher;

            $data = Student::where('school_id', $schoolId->school_id)->get();
            // dd($data);
            return view('school.student', compact('data'));
        }
    }

    public function profile($id)
    {
        $data = Student::find($id);
        return view('school.studentprofile', compact('data'));
    }
}
