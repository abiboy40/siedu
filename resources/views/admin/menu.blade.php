@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu Management</h3>
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
                                <th>Menu Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menu as $m)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $m->name }}</td>
                                <td>
                                    @if($m->is_active == 1)
                                    <a href="/menu/{{ $m->id }}/edit" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></a>
                                    <a href="/menu/{{ $m->id }}/deactivated" class="btn btn-sm btn-danger"><i class="fas fa-power-off"></i></a>
                                    @else
                                    <a href="/menu/{{ $m->id }}/activated" class="btn btn-sm btn-success"><i class="fas fa-power-off"></i></a>
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
@endsection