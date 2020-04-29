@extends('layouts.main')
@section('content')
<div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add / Update Schedule</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="/classroom/{{ $subject[0]->classroom_id}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="classroom" value="{{ $subject[0]->classroom_id}}">
                        <input type="hidden" name="hari" value="{{ $subject[0]->hari}}">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="hour">Hour</label>
                                @foreach($subject as $sub)
                                <select id="hour" class="custom-select" name="hour">
                                    <option>Choose...</option>
                                    <option value="1" @if($sub->jam == 1) selected @endif>I</option>
                                    <option value="2" @if($sub->jam == 2) selected @endif>II</option>
                                    <option value="3" @if($sub->jam == 3) selected @endif>III</option>
                                    <option value="4" @if($sub->jam == 4) selected @endif>IV</option>
                                    <option value="5" @if($sub->jam == 5) selected @endif>V</option>
                                    <option value="6" @if($sub->jam == 6) selected @endif>VI</option>
                                    <option value="7" @if($sub->jam == 7) selected @endif>VII</option>
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="subject">Subject</label>
                                <select id="subject" class="custom-select" name="subject">
                                    <option>Choose...</option>
                                    @foreach($allsub as $all)
                                    <option value="{{ $all->id}}" @if($sub->id == $all->id) selected @endif>{{ $all->subject}} - {{ $all->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary float-right m-1">Save</button>
                        <a href="/classroom/{{ $subject[0]->classroom_id}}" class=" btn btn-secondary float-right m-1">Cancel</a>
                    </form>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection