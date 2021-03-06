@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Role</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>
                                    @if($role->is_active == 1)
                                    <a href="/role/{{ $role->id }}/edit" class="badge badge-pill badge-primary">Acsess</a>
                                    <a href="/role/{{ $role->id }}/deactivated" class="badge badge-pill badge-danger" aria-disabled="true"> Deactivated</a>
                                    @else
                                    <a href="/role/{{ $role->id }}/activated" class="badge badge-pill badge-success"> Activated</a>
                                    @endif
                                </td>
                                <td></td>
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