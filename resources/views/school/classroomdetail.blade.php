@extends('layouts.main')
@section('content')
<div class="content" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Class Detail</h3>

                <div class="card-tools">
                    <a href="/classroom" class=" btn btn-light"><i class="fas fa-backward"></i></a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#students" data-toggle="tab">Students</a></li>
                                <li class="nav-item"><a class="nav-link" href="#schedule" data-toggle="tab">Schedule</a></li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="students">
                                    <!-- list of student -->
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Family Member of Class {{ $class->grade }}-{{ $class->prefix }}</h3>

                                                <div class="card-tools">
                                                    <form action="/classroom/{{ $class->id }}" method="GET">
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <input type="text" name="search" class="form-control float-right" placeholder="Search">
                                                            <div class="input-group-append">
                                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="height: 300px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>NIS</th>
                                                        <th>Name</th>
                                                        <th>Place 0f Birth</th>
                                                        <th>Date 0f Birth</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($student as $std)
                                                    <tr>
                                                        <td>{{ $std->nis }}</td>
                                                        <td>{{ $std->name }}</td>
                                                        <td>{{ $std->place_of_birth }}</td>
                                                        <td>@php echo date('d-m-Y', strtotime($std->date_of_birth)) @endphp</td>
                                                        <td>{{ $std->student_email }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- end of student list -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="schedule">
                                <div class="float-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSchedule"><i class="far fa-plus-square"></i>
                                    </button>
                                </div>
                                <div class="row d-flex align-items-stretch">
                                    @foreach($schedule as $sch)
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box">
                                            @php
                                            $subject = DB::table('classroom_subjects')
                                            ->join('subject_teachers','subject_teachers.id','=','classroom_subjects.subject_teacher_id')
                                            ->join('subjects', 'subjects.id','=','subject_teachers.subject_id')
                                            ->join('teachers','teachers.id','=','subject_teachers.teacher_id')
                                            ->select('classroom_subjects.id','classroom_subjects.hari','classroom_subjects.jam','subjects.subject','teachers.name')
                                            ->where('classroom_subjects.classroom_id',$sch->classroom_id)
                                            ->where('classroom_subjects.hari',$sch->hari)
                                            ->orderBy('classroom_subjects.jam','asc')->get();
                                            @endphp
                                            <span class="info-box-icon bg-warning"></span></a>
                                            <div class="info-box-content">
                                                @if($sch->hari == 1)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Senin</span>
                                                @endif
                                                @if($sch->hari == 2)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Selasa</span>
                                                @endif
                                                @if($sch->hari == 3)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Rabu</span>
                                                @endif
                                                @if($sch->hari == 4)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Kamis</span>
                                                @endif
                                                @if($sch->hari == 5)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Jum'at</span>
                                                @endif
                                                @if($sch->hari == 6)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Sabtu</span>
                                                @endif
                                                @if($sch->hari == 7)
                                                <span class="info-box-number"><i class="fas fa-clipboard-list"></i> Minggu</span>
                                                @endif
                                                @foreach($subject as $sub)
                                                <a href="/classroom/{{ $sub->id }}/edit"> <span class="info-box-text">{{ $sub->jam }} - {{ $sub->subject }}</span></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="activity">

                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
</div>
<!-- /.card-body -->
<div class="card-footer" style="display: block;">
    Footer
</div>
<!-- /.card-footer-->
</div>
</section>
</div>

<!-- Modal New Schedule -->
<div class="modal fade" id="newSchedule" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newScheduleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newScheduleLabel">New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/classroom/addschedule" method="POST">
                    @csrf
                    <input type="hidden" name="classroom" value="{{ $class->id}}">
                    <div class="form-group">
                        <label for="hour">Day</label>
                        <select id="day" class="custom-select" name="day">
                            <option>Choose...</option>
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jum'at</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="hour">Hour</label>
                            <select id="hour" class="custom-select" name="hour">
                                <option>Choose...</option>
                                <option value="1">I</option>
                                <option value="2">II</option>
                                <option value="3">III</option>
                                <option value="4">IV</option>
                                <option value="5">V</option>
                                <option value="6">VI</option>
                                <option value="7">VII</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="subject">Subject</label>
                            <select id="subject" class="custom-select" name="subject">
                                <option>Choose...</option>
                                @foreach($jadwal as $jad)
                                <option value="{{ $jad->id }}">{{ $jad->subject}} - {{ $jad->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection