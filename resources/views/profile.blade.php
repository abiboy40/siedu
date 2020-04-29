@extends('layouts.main')
@section('title', 'My Profile')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/adminlte/img/{{ $data->foto }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $data->name }}</h3>

                        <p class="text-muted text-center">NIP: {{ $data->nip }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Position</b> <a class="float-right">{{ $data->departement }}</a>
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
                            {{ $data->place }}, @php echo date('d-m-Y', strtotime($data->date)) @endphp
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
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Subject</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Update Profile</a></li>
                        </ul>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"><i class="far fa-plus-square"></i></button>
                            <a href="/staff" class=" btn btn-light"><i class="fas fa-backward"></i></a>
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

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                Coming Soon
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal" method="POST" action="/teacher/{{ $data->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label for="inputNIP" class="col-sm-2 col-form-label">NIP & Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputNIP" name="inputNIP" value="{{ $data->nip }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="inputName" name="inputName" value="{{ $data->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPlace" class="col-sm-2 col-form-label">Birthday</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPlace" name="inputPlace" value="{{ $data->place }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="inputDate" name="inputDate" value="{{ $data->date }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ $data->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="{{ $data->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputTelp" class="col-sm-2 col-form-label">Telp</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputTelp" name="inputTelp" value="{{ $data->telp1 }}">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputTelp2" name="inputTelp2" value="{{ $data->telp2 }}">
                                        </div>
                                    </div>
                                    <div class=" form-group row">
                                        <label for="inputDept" class="col-sm-2 col-form-label">Departement & Status</label>
                                        <div class="col-sm-5">
                                            <select id="departemen" class="custom-select" name="departement">
                                                <option>Departemen...</option>
                                                <option value="Administration" @if($data->departement == 'Administration') selected @endif>Administration</option>
                                                <option value="Teacher" @if($data->departement == 'Teacher') selected @endif>Teacher</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <select id="Status" class="custom-select" name="status">
                                                <option>Status...</option>
                                                <option value="Permanent" @if($data->status == 'Permanent') selected @endif>Permanent</option>
                                                <option value="Honorer" @if($data->status == 'Honorer') selected @endif>Honorer</option>
                                            </select>
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
@endsection