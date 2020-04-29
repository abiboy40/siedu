@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Subject Management</h3>
                    <div class="float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SubjectTeacherModal">
                            <i class="fas fa-link"></i>
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSubjectModal">
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subject as $sub)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sub->subject }}</td>
                                <td>{{ $sub->name }}</td>
                                <td>
                                    @if($sub->is_active == 1)
                                    <a href="/subject/{{ $sub->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></a>
                                    <a href="/menu/{{ $sub->id }}/deactivated" class="btn btn-sm btn-danger"><i class="fas fa-power-off"></i></a>
                                    @else
                                    <a href="/menu/{{ $sub->id }}/activated" class="btn btn-sm btn-success"><i class="fas fa-power-off"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

<!-- Modal New Subject-->
<div class="modal fade" id="newSubjectModal" tabindex="-1" role="dialog" aria-labelledby="newSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubjectModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/subject" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject">Subject Name</label>
                        <input type="text" class="form-control" id="subejct" name="subject" placeholder="Subejct Name">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add New</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Model New Subject -->

<!-- Modal Subject Teacher-->
<div class="modal fade" id="SubjectTeacherModal" tabindex="-1" role="dialog" aria-labelledby="SubjectTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubjectTeacherModalLabel">Teacher-Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/subject/teacher" method="POST">
                    @csrf
                    <input type="hidden" name="schoolId" id="schoolId" value="{{ $sub->school_id }}">
                    <div class="form-group">
                        <label for="subjectlist">Subject</label>
                        <select class="custom-select" name="subjectlist" id="subjectlist">
                            @foreach($allsubject as $allsub)
                            <option value="{{ $allsub->id }}">{{ $allsub->subject }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacherlist">Teacher</label>
                        <select class="custom-select" name="teacherlist" id="teacherlist">
                            @foreach($allteacher as $allteach)
                            <option value="{{ $allteach->id }}">{{ $allteach->name }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection