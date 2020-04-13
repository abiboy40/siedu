@extends('layouts.main')
@section('title', 'Add New Staff')
@section('content')
<div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('teacher') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(Auth::User()->id != 1)
                <input type="hidden" name="schoolId" value="{{ $data->school_id}}">
                @else
                <div class="form-group>
                    <label for=" schoolId"><b>School</label>
                        <select id="schoolId" class="form-control" name="schoolId">
                            <option>Choose...</option>
                            @foreach($school as $school)
                            <option value="{{ $school->id}}">{{ $school->name}}</option>
                            @endforeach
                        </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="nip">Employee Id</label>
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}">
                    @error('nip')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Employee Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="telp">Telp</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telp2">Telp 2</label>
                        <input type="text" class="form-control" id="telp2" name="telp2" value="{{ old('telp2') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fax">Status</label>
                        <select id="Status" class="form-control" name="status">
                            <option>Choose...</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Honorer">Honorer</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="departemen">Departemen</label>
                        <select id="departemen" class="form-control" name="departement">
                            <option>Choose...</option>
                            <option value="Administration">Administration</option>
                            <option value="Teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="foto">Profile Foto</label>
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right m-1">Save</button>
                <a href="/staff" class=" btn btn-primary float-right m-1">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection