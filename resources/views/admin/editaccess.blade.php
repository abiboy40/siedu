@extends('layouts.main')
@section('title','User Access')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Role: {{ $data->role_name }}</h3>
                    <a href="{{url('/role')}}" class=" btn btn-light float-right"><i class="fas fa-backward"></i></a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('storeaccess') }}" method="post">
                        @csrf
                        <input name="roleid" type="hidden" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="menulist">Available Menu</label>
                            <select class="custom-select" name="menulist" id="menulist">
                                @foreach($allmenu as $all)
                                <option data-id="{{ $all->menu_id }}" value="{{ $all->id }}">{{ $all->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="txtmenu" name="txtmenu">
                        </div>
                        <button type="submit" class="badge badge-success pt-1"><i class="fas fa-plus"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selected Menu</h3>
                </div>
                <!-- /.card-header -->
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
                            @foreach($menu as $m)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $m->name}}</td>
                                <td>
                                    <form action="/role/{{ $m->id}}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="badge badge-warning" onclick="return confirm('Yakin ingin dihapus?;')"><i class="far fa-trash-alt"></i></button>
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