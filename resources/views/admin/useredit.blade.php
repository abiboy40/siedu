@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="/user/{{$data->id}}/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data->name }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $data->email }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select id="role" class="custom-select" name="role">
                                    <option>Choose...</option>
                                    @foreach($role as $r)
                                    if($r->id == $data->role_id)
                                    <option value="{{ $r->id}}" @if($r->id === $data->role_id)
                                        selected
                                        @endif>
                                        {{ $r->role_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="isactive">Is Active</label>
                                <select id="isactive" class="custom-select" name="isactive">
                                    <option>Choose...</option>
                                    <option value="1" @if($data->is_active == 1)
                                        selected
                                        @endif>
                                        Active</option>
                                    <option value="0" @if($data->is_active == 0)
                                        selected
                                        @endif>Not Active</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right m-1">Update</button>
                        <a href="/user" class=" btn btn-secondary float-right m-1">Cancel</a>
                    </form>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection