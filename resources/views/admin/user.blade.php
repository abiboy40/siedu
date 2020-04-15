@extends('layouts.main')
@section('title','User')
@section('content')
<div class="container-fluid">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Users</h3>
                    <form class="form-inline ml-3 float-right" action="/user" method="get">
                        <div class="input-group input-group-sm">
                            <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $data->name}}</td>
                                <td>{{ $data->email}}</td>
                                <td>{{ $data->role_name}}</td>
                                <td>
                                    @if($data->is_active == 1)
                                    Active
                                    @else
                                    Not Active
                                    @endif
                                </td>
                                <td>
                                    <form action="/user/{{ $data->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <a href="/user/{{ $data->id}}/edit" class="badge badge-secondary"><i class="far fa-edit"></i></a>
                                        <button type="submit" class="badge badge-danger" onclick="return confirm('Yakin ingin dihapus?;')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>

                </div>
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
@endsection