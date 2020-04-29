<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\School;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 5) {
            $school = Teacher::where('user_id', Auth::user()->id)->get();
            $class = DB::table('classrooms')->where('classrooms.school_id', $school[0]->school_id)->get();
        } elseif (Auth::user()->role_id == 1) {
            $class = Classroom::all();
            // dd($class);
        }

        return view('school.classroom', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        Classroom::create($request->all());
        return redirect('/classroom')->with('status', 'New Classrooms has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $class = Classroom::find($id);
        //get schedules
        $schedule = DB::table('classroom_subjects')
            ->distinct()->select('classroom_subjects.hari', 'classroom_subjects.classroom_id')
            ->where('classroom_subjects.classroom_id', $id)->orderBy('classroom_subjects.hari', 'asc')->get();

        // dd($schedule->all());
        //ini khusu buat kelas yang belum ada jadwalnya
        $jadwal = DB::table('subject_teachers')
            ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
            ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
            ->select('subject_teachers.id', 'subjects.subject', 'teachers.name')
            ->where('subject_teachers.school_id', $class->school_id)->get();
        // dd($jadwal);        

        if ($request->has('search')) {
            //get students
            $student = DB::table('classroom_students')
                ->join('Students', 'Students.id', '=', 'classroom_students.student_id')
                ->select('Students.nis', 'Students.name', 'Students.place_of_birth', 'Students.date_of_birth', 'Students.student_email')
                ->where('name', 'LIKE', '%' . $request->search . '%')
                ->where('classroom_students.classroom_id', $id)->get();

            return view('school.classroomdetail', ['student' => $student, 'class' => $class,  'schedule' => $schedule, 'jadwal' => $jadwal]);
        } else {
            $student = DB::table('classroom_students')
                ->join('Students', 'Students.id', '=', 'classroom_students.student_id')
                ->select('Students.nis', 'Students.name', 'Students.place_of_birth', 'Students.date_of_birth', 'Students.student_email')
                ->where('classroom_students.classroom_id', $id)->get();

            return view('school.classroomdetail', ['student' => $student, 'class' => $class, 'schedule' => $schedule, 'jadwal' => $jadwal]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id == 0) {
            $subject = DB::table('classroom_subjects')
                ->join('subject_teachers', 'subject_teachers.id', '=', 'classroom_subjects.subject_teacher_id')
                ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
                ->distinct()->select('classroom_subjects.classroom_id', 'classroom_subjects.hari', 'classroom_subjects.jam', 'subjects.subject', 'teachers.name', 'teachers.school_id', 'subject_teachers.id')
                ->orderBy('subjects.id')->get();

            $allsub = DB::table('subject_teachers')
                ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
                ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                ->select('subject_teachers.id', 'Subjects.subject', 'teachers.name')
                ->where('subject_teachers.school_id', $subject[0]->school_id)->get();
            dd($subject);
        } else {

            $subject = DB::table('classroom_subjects')
                ->join('subject_teachers', 'subject_teachers.id', '=', 'classroom_subjects.subject_teacher_id')
                ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
                ->select('classroom_subjects.classroom_id', 'classroom_subjects.hari', 'classroom_subjects.jam', 'subjects.subject', 'teachers.name', 'teachers.school_id', 'subject_teachers.id')
                ->where('classroom_subjects.id', $id)->get();

            $allsub = DB::table('subject_teachers')
                ->join('teachers', 'teachers.id', '=', 'subject_teachers.teacher_id')
                ->join('subjects', 'subjects.id', '=', 'subject_teachers.subject_id')
                ->select('subject_teachers.id', 'Subjects.subject', 'teachers.name')
                ->where('subject_teachers.school_id', $subject[0]->school_id)->get();
        }
        // dd($subje);
        return view('school.schedule', ['subject' => $subject, 'allsub' => $allsub]);
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
        DB::table('classroom_subjects')
            ->updateOrInsert(
                ['jam' => Request('hour'), 'classroom_id' => Request('classroom'), 'hari' => Request('hari')],
                ['subject_teacher_id' => Request('subject')]
            );

        return redirect('/classroom/' . $id)->with('status', 'Data successfully add/update!!');
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

    public function addSchedule(Request $request)
    {
        DB::table('classroom_subjects')->insert(
            [
                'classroom_id' => $request->classroom,
                'subject_teacher_id' => $request->subject,
                'hari' => $request->day,
                'jam' => $request->hour
            ]
        );

        return back();
    }
}
