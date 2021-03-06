<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use App\Models\Teacher;
use App\Models\TempUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::where('school_id', Auth::user()->teacher->school_id)->get();
        return view('school.teacher', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = School::all();
        $User = User::find(Auth::user()->id)->teacher;
        return view('school.teacherreg', ['data' => $User, 'school' => $school]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'email:rfc,dns',
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
            'password' => Hash::make('password')
        ]);

        Teacher::create(
            [
                'user_id' => $user->id,
                'school_id' => request('schoolId'),
                'nip' => request('nip'),
                'name' => request('name'),
                'place' => request('place'),
                'date' => request('date'),
                'address' => request('address'),
                'telp1' => request('telp'),
                'telp2' => request('telp2'),
                'email' => request('email'),
                'departement' => request('departement'),
                'status' => request('status'),
                'foto' => $namaBaru
            ]
        );

        return redirect('/staff')->with('status', 'New Data Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Teacher::find($id);
        return view('/profile', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // dd($request->all());
        $request->validate([
            'inputNIP' => 'required',
            'inputName' => 'required',
            'inputEmail' => 'email:rfc,dns',
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

        Teacher::where('id', $id)
            ->update(
                [
                    'nip' => request('inputNIP'),
                    'name' => request('inputName'),
                    'place' => request('inputPlace'),
                    'date' => request('inputDate'),
                    'address' => request('inputAddress'),
                    'telp1' => request('inputTelp'),
                    'telp2' => request('inputTelp2'),
                    'email' => request('inputEmail'),
                    'departement' => request('departement'),
                    'status' => request('status'),
                    'foto' => $namaBaru
                ]
            );

        return redirect('/staff')->with('status', 'Data Successfully Updated!');
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

    public function saveto_table()
    {
        foreach (TempUser::cursor() as $data) {

            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make('password'),
                'role_id' => 2
            ]);

            Teacher::create(
                [
                    'user_id' => $user->id,
                    'school_id' => $data->schoolId,
                    'nip' => $data->nip,
                    'name' => $data->name,
                    'address' => $data->address,
                    'email' => $data->email,
                    'departement' => $data->departement
                ]
            );
        }
        DB::table('temp_users')->truncate();
        return back()->with('status', 'Data Successfully Saved!');
    }
}
