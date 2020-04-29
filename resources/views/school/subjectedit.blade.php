@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Subject - Teacher</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="/subject/{{$subject[0]->id}}" method="POST">
                        @method('patch')
                        @csrf
                        <input type="hidden" name="school_id" value="{{$subject[0]->school_id}}">
                        <div class="form-group">
                            <label for="subjectlist">Subject</label>
                            <select class="custom-select" name="subjectlist" id="subjectlist">
                                @foreach($allsubject as $allsub)
                                <option value="{{ $allsub->id}}" @if($allsub->subject == $subject[0]->subject) selected @endif>{{ $allsub->subject}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="teacherlist">Teacher</label>
                            <select class="custom-select" name="teacherlist" id="teacherlist">
                                @foreach($allteacher as $allteach)
                                <option value="{{ $allteach->id }}" @if($allteach->name == $subject[0]->name) selected @endif>{{ $allteach->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <a href="/subject" class=" btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection