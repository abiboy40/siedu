<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SI Edu') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'SI Edu') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="/">{{ __('Home') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container pt-2">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header card-fuchsia text-center">{{ __('School Registration') }}</div>
                        <div class="card-body">
                            <form method="post" action="{{ url('school') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">School Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">

                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">

                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="telp">Telp</label>
                                        <input type="text" class="form-control" id="telp1" name="telp1" value="{{ old('telp1') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="telp2">Telp 2</label>
                                        <input type="text" class="form-control" id="telp2" name="telp2" value="{{ old('telp2') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="fax">Fax</label>
                                        <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">

                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="curriculum">Curriculum</label>
                                        <select id="curriculum" class="form-control" name="curriculum">
                                            <option>Choose...</option>
                                            <option>Kurikulum 2013</option>
                                            <option>Cambridge</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="num_of_Staff">Num of Staff</label>
                                        <input type="text" class="form-control" id="num_of_Staff" name="num_of_Staff" value="{{ old('num_of_Staff') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="num_of_student">Num of Student</label>
                                        <input type="text" class="form-control" id="num_of_student" name="num_of_student" value="{{ old('num_of_student') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>