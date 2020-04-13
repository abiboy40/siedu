<?php

namespace App\Http\Controllers;

use App\Imports\TempUsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\School;
use App\Models\TempUser;

class ImportExcelController extends Controller
{
    function index()
    {
        $data = DB::table('temp_users')->get();
        $user = User::find(Auth::user()->id)->teacher;
        $school = School::all();
        return view('import_excel', ['data' => $data, 'user' => $user, 'school' => $school]);
    }

    function import(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'filename' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new TempUsersImport(), $request->file('filename'));

        $data = TempUser::all();
        // dd($data);
        if ($data->count() > 0) {
            foreach ($data as $data) {
                TempUser::where('id_number', $data->id_number)
                    ->update(['schoolId' => request('schoolId')]);
            }
        }

        return back()->with('status', 'Data Successfully Imported!');
    }

    function clear()
    {
        DB::table('temp_users')->truncate();
        return back()->with('status', 'Data Successfully Deleted!');
    }
}
