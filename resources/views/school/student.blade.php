@extends('layouts.main')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-9">
            <h3>Students</h3>
        </div>
        <div class="col-md-3 float-right">
            <!-- Button trigger modal -->
            <a href="/student/import" class="btn btn-primary"> <i class="fas fa-cloud-upload-alt"></i> Import Excel</i></a>
            <!-- <a href="{{ route('new_teacher') }}" class="btn btn-primary"> </a> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newStudent"><i class="far fa-plus-square"></i>
            </button>
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
                @foreach($data as $dt)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            {{ $dt->nis }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $dt->name }}</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>{{ $dt->address}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{ $dt->student_email}}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="/adminlte/img/{{ $dt->foto}}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="/student/{{ $dt->id }}" class="btn btn-sm btn-primary">
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
<div class="modal fade" id="newStudent" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newStudentLabel">New student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/student" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="schoolId" value="{{ $dt->school_id}}">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="nis">NIS</label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}">
                                @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="grade">Grade</label>
                                <input type="text" class="form-control @error('grade') is-invalid @enderror" id="grade" name="grade" value="{{ old('grade') }}">
                                @error('grade')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="place">Place of Birth</label>
                                <input type="text" class="form-control @error('place') is-invalid @enderror" id="place" name="place" value="{{ old('place') }}">
                                @error('place')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">Date of Birth</label>
                                <input type="text" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" placeholder="yyyy-mm-dd">
                                @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="father">Father's Name</label>
                                <input type="text" class="form-control" id="father" name="father" value="{{ old('father') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mother">Mother's Name</label>
                                <input type="text" class="form-control" id="mother" name="mother" value="{{ old('mother') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="parent_email">Parent Email</label>
                                <input type="email" id="parent_email" name="parent_email" class="form-control @error('parent_email') is-invalid @enderror" value="{{ old('parent_email') }}">
                                @error('parent_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="foto">Profile Foto</label>
                                <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto">
                                @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection