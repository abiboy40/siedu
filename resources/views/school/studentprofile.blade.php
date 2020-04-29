@extends('layouts.main')
@section('title', 'My Profile')
@section('content')
<section class="content">
    <div class="container-fluid">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/adminlte/img/{{ $data->foto }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $data->name }}</h3>

                        <p class="text-muted text-center">Grade: {{ $data->grade }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Rank</b> <a class="float-right">1</a>
                            </li>
                            <li class="list-group-item">
                                <b>Average Score</b> <a class="float-right">90</a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Birthday</strong>

                        <p class="text-muted">
                            {{ $data->place_of_birth }}, @php echo date('d-m-Y', strtotime($data->date_of_birth)) @endphp
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                        <p class="text-muted">{{ $data->address }}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Score</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update Profile</a></li>
                        </ul>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="far fa-plus-square"></i></button>
                            <a href="/student" class=" btn btn-light"><i class="fas fa-backward"></i></a>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <table class="table table-striped text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subject</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->subject as $subject)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->pivot->score }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                Coming Soon
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal" action="/student/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputGrade" class="col-sm-2 col-form-label">Grade & NIS</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="inputGrade" name="inputGrade" value="{{ $data->grade }}">
                                        </div>
                                        <div class=" col-sm-7">
                                            <input type="text" class="form-control" id="inputNIS" name="inputNIS" value="{{ $data->nis }}">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="inputName" value="{{ $data->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Birthday</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputPlace" name="inputPlace" value="{{ $data->place_of_birth }}">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputDate" name="inputDate" value="{{ $data->date_of_birth }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ $data->student_email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="inputAddress" name="inputAddress" value="{{ $data->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Parent Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputFather" name="inputFather" value="{{ $data->father_name }}">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputMother" name="inputMother" value="{{ $data->mother_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail2" class="col-sm-2 col-form-label">Parent's Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail2" name="inputEmail2" value="{{ $data->parent_email }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-2 col-form-label">Profile Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control-file" id="foto" name="foto">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    </div>
                    </card-body>
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