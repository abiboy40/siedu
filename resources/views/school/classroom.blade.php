@extends('layouts.main')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-11">
            <h3>Classroom</h3>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newClass"><i class="far fa-plus-square"></i>
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
                @foreach($class as $c)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Classroom</span>
                            <span class="info-box-number">{{ $c->grade }}-{{ $c->prefix }} </span>
                            <span class="info-box-text"></span>
                            <a href="/classroom/{{ $c->id }}" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
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

<!-- Modal new Classroom -->
<div class="modal fade" id="newClass" tabindex="-1" role="dialog" aria-labelledby="newClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newClassModalLabel">Create Classroom</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/classroom" method="POST">
                    @csrf
                    <input type="hidden" name="school_id" id="school_id" value="{{ $c->school_id }}">
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" class="form-control" id="grade" name="grade" placeholder="Grade">
                    </div>
                    <div class="form-group">
                        <label for="prefix">Prefix</label>
                        <input type="text" class="form-control" id="prefix" name="prefix" placeholder="prefix">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection