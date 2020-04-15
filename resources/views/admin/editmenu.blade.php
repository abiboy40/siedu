@extends('layouts.main')
@section('title','Submenu Management')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu: {{ $menu->name }}</h3>
                    <a href="/menu" class=" btn btn-light float-right pl-1"><i class="fas fa-backward"> Back</i></a>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submenu as $sub)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $sub->name}}</td>
                                <td>
                                    @if($sub->is_active == 1)
                                    <a href="/submenu/{{ $sub->id }}/deactivated" class="btn btn-sm btn-danger"><i class="fas fa-power-off"></i></a>
                                    @else
                                    <a href="/submenu/{{ $sub->id }}/activated" class="btn btn-sm btn-success"><i class="fas fa-power-off"></i></a>
                                    @endif
                                </td>
                </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection