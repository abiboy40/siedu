@extends('layouts.main')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-9">
            <h3>Contacts</h3>
        </div>
        <div class="col-md-2">
            <a href="{{ route('importExcel') }}" class="btn btn-primary"> Import Excel</i></a>
        </div>
        <div class="col-md-1">
            <!-- Button trigger modal -->
            <a href="{{ route('new_teacher') }}" class="btn btn-primary"> <i class="far fa-plus-square"></i></a>
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"> -->
            <!-- </button> -->
        </div>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @foreach($teacher as $teacher)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            {{ $teacher->departement }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $teacher->name }}</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>{{ $teacher->address}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{ $teacher->telp1}}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="/adminlte/img/{{ $teacher->foto}}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                </ul>
            </nav>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<!-- Modal -->
<!-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('teacher') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nip">Employee Id</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
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
                                <select id="Status" class="form-control" name="curriculum">
                                    <option>Choose...</option>
                                    <option value="permanent">permanent</option>
                                    <option value="Honorer">Honorer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="departemen">Departemen</label>
                                <select id="departemen" class="form-control" name="departemen">
                                    <option>Choose...</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Teacher">Teacher</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Profile Foto</label>
                                <input type="file" class="form-control-file" id="exampleInputFile">
                            </div>
                        </div>
                    </div> -->
<!-- /.card-body -->
<!-- </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
@endsection