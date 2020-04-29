<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\TempUser;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class StudentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $data = Student::all();
            return view('school.student', compact('data'));
        } elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 5) {
            $schoolId = User::find(Auth::user()->id)->teacher;
            // dd($schoolId);
            $data = Student::where('school_id', $schoolId->school_id)->get();

            if ($data->count() == 0) {
                return view('school.student', ['school' => $schoolId, 'data' => $data]);
            }
            return view('school.student', compact('data'));
        }

        $data = Student::where('user_id', '=', Auth::user()->id)
            ->orwhere('parent_email', Auth::user()->email)->get();
        // dd($data);
        return view('school.student', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nis' => 'required',
            'grade' => 'required',
            'name' => 'required',
            'place' => 'required',
            'date' => 'required',
            'address' => 'required',
            'email' => 'required|email:rfc,dns',
            'parent_email' => 'required|email:rfc,dns',
            'foto' => 'image|mimes:png,jpg,jpeg,gif|max:200'
        ]);
        //Cek File Foto
        if ($request->hasFile('foto')) {
            $namaFile = $_FILES['foto']['name'];
            $error = $_FILES['foto']['error'];
            $temp = $_FILES['foto']['tmp_name'];

            if ($error == 4) {
                return false;
            }

            $ekstensiFile = explode('.', $namaFile);
            $ekstensiFile = strtolower(end($ekstensiFile));
            $lokasiFile = base_path() . '\public\adminlte\img';


            //mengubah nama file
            $namaBaru = uniqid();
            $namaBaru .= '.';
            $namaBaru .= $ekstensiFile;

            //upload fie
            move_uploaded_file($temp, $lokasiFile . '/' . $namaBaru);
        } else {
            $namaBaru = 'no_photo.png';
        }


        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make('password'),
            'role_id' => 4
        ]);

        Student::create(
            [
                'school_id' => request('schoolId'),
                'user_id' => $user->id,
                'nis' => request('nis'),
                'name' => request('name'),
                'place_of_birth' => request('place'),
                'date_of_birth' => request('date'),
                'address' => request('address'),
                'student_email' => request('email'),
                'father_name' => request('father'),
                'mother_name' => request('mother'),
                'parent_email' => request('parent_email'),
                'foto' => $namaBaru
            ]
        );

        $user = User::create([
            'name' => request('father'),
            'email' => request('parent_email'),
            'password' => Hash::make('password'),
            'role_id' => 4
        ]);

        return redirect('/student')->with('status', 'New Data Added!');
    }

    public function show($id)
    {

        $data = Student::findorFail($id);
        return view('school.studentprofile', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'inputNIS' => 'required',
            'inputGrade' => 'required',
            'inputName' => 'required',
            'inputPlace' => 'required',
            'inputDate' => 'required',
            'inputAddress' => 'required',
            'inputEmail' => 'required|email:rfc,dns',
            'inputEmail2' => 'required|email:rfc,dns',
            'foto' => 'image|mimes:png,jpg,jpeg,gif|max:200'
        ]);
        //Cek File Foto
        if ($request->hasFile('foto')) {
            $namaFile = $_FILES['foto']['name'];
            $error = $_FILES['foto']['error'];
            $temp = $_FILES['foto']['tmp_name'];

            if ($error == 4) {
                return false;
            }

            $ekstensiFile = explode('.', $namaFile);
            $ekstensiFile = strtolower(end($ekstensiFile));
            $lokasiFile = base_path() . '\public\adminlte\img';


            //mengubah nama file
            $namaBaru = uniqid();
            $namaBaru .= '.';
            $namaBaru .= $ekstensiFile;

            //upload fie
            move_uploaded_file($temp, $lokasiFile . '/' . $namaBaru);
        } else {
            $namaBaru = 'no_photo.png';
        }

        Student::where('id', $id)
            ->update([
                'nis' => request('inputNIS'),
                'grade' => request('inputGrade'),
                'name' => request('inputName'),
                'place_of_birth' => request('inputPlace'),
                'date_of_birth' => request('inputDate'),
                'address' => request('inputAddress'),
                'student_email' => request('inputEmail'),
                'father_name' => request('inputFather'),
                'mother_name' => request('inputMother'),
                'parent_email' => request('inputEmail2'),
                'foto' => $namaBaru
            ]);

        return back()->with('status', 'Data Updated!!');
    }

    public function saveto_table()
    {
        foreach (TempUser::cursor() as $data) {
            // dd($data);
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make('password'),
                'role_id' => 4,
                'is_active' => 1
            ]);

            Student::create(
                [
                    'user_id' => $user->id,
                    'school_id' => $data->schoolId,
                    'nis' => $data->id_number,
                    'name' => $data->name,
                    'place_of_birth' => $data->place,
                    'date_of_birth' => $data->date,
                    'address' => $data->address,
                    'student_email' => $data->email,
                    'parent_email' => $data->parent_email
                ]
            );

            $email = User::where('email', $data->parent_email)->get();

            if ($email->count() == 0) {
                User::create([
                    'name' => $data->name,
                    'email' => $data->parent_email,
                    'password' => Hash::make('password'),
                    'role_id' => 4,
                    'is_active' => 1
                ]);
            }
        }
        DB::table('temp_users')->truncate();
        return back()->with('status', 'Data Successfully Saved!');
    }
}
