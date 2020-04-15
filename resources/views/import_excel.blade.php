@extends('layouts.main')
@section('title', 'Import Data')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">Choose File to Upload</div>
                        <div class="card-body">
                            <form action="{{ route('startImport') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(Auth::User()->id != 1)
                                <input type="hidden" name="schoolId" value="{{ $user->school_id}}">
                                @else
                                <div class="form-group row">
                                    <label for="schoolId" class="col-sm-2 col-form-label">School</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="schoolId" name="schoolId">
                                            <option>Choose..</option>
                                            @foreach($school as $school)
                                            <option value="{{ $school->id}}">{{ $school->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="filename" class="col-sm-2 col-form-label">Choose File</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control-file @error('filename') is-invalid @enderror" id="filename" name="filename">
                                        @error('filename')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <a href="/staff" class="btn btn-secondary"> Cancel</a>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Imported Data</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Departement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->id_number }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->departement }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-1 float-right">
                        <a href="{{ route('cleardata') }}" class="btn btn-flat btn-primary">Clear</a>
                        <a href="{{ route('TeacherSave') }}" class="btn btn-flat btn-primary">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection