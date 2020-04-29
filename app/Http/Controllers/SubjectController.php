<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $allsubject = Subject::where('is_active', 1)->get();

        // dd($allteacher);
        if (Auth::user()->role_id == 5) {
            $role = User::find(Auth::user()->id)->teacher;

            $subject = DB::table('subject_teachers')
                ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
                ->select('subject_teachers.id', 'subjects.subject', 'teachers.name', 'teachers.school_id', 'subject_teachers.is_active')->where('teachers.departement', 'teacher')
                ->where('teachers.school_id', $role->school_id)->where('subject_teachers.is_active', 1)->get();

            $allteacher = Teacher::where('departement', 'teacher')->where('school_id', $role->school_id)->get();
        } else {

            // $subject = $allsubject;
            $subject = DB::table('subject_teachers')
                ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
                ->select('subject_teachers.id', 'subjects.subject', 'teachers.name', 'teachers.school_id', 'subject_teachers.is_active')
                ->where('teachers.departement', 'teacher')->where('subject_teachers.is_active', 1)->get();
            $teacher = Teacher::where('departement', 'teacher')->get();
            $allteacher = $teacher;
        }

        return view('school.subject', ['subject' => $subject, 'allsubject' => $allsubject, 'allteacher' => $allteacher]);
    }

    public function store(Request $request)
    {
        Subject::create($request->all());
        return redirect('/subject')->with('status', 'New Subject Successfully Added!');
    }

    public function edit($id)
    {
        $subject = DB::table('subject_teachers')
            ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
            ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
            ->select('subject_teachers.id', 'subjects.subject', 'teachers.name', 'teachers.school_id', 'subject_teachers.is_active')->where('teachers.departement', 'teacher')
            ->where('subject_teachers.id', $id)->get();

        $allsubject = Subject::where('is_active', 1)->get();
        $allteacher = Teacher::where('departement', 'teacher')->where('school_id', $subject[0]->school_id)->get();
        // dd($subject);
        return view('school.subjectedit', ['subject' => $subject, 'allsubject' => $allsubject, 'allteacher' => $allteacher]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        SubjectTeacher::where('id', $id)
            ->update([
                'school_id' => $request->school_id,
                'subject_id' => $request->subjectlist,
                'teacher_id' => $request->teacherlist
            ]);

        return redirect('/subject')->with('status', 'Data has been updated!!');
    }

    public function subjectteacher(Request $request)
    {
        // dd($request->all());
        SubjectTeacher::create([
            'school_id' => $request->schoolId,
            'subject_id' => $request->subjectlist,
            'teacher_id' => $request->teacherlist
        ]);
        return redirect('/subject')->with('status', 'Subject and Teacher Successfully Linked!');
    }
}
