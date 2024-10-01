<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href={{ asset("admin/vendor/fontawesome-free/css/all.min.css") }} rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset("admin/css/sb-admin-2.min.css") }} rel="stylesheet">
    
    <style>
        .logoLatahzan {
            width: 300px;
            height: 300px;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <div class="p-5">
                            <img class="logoLatahzan" src="{{ asset('img/latahzanEdu.jpg') }}" alt="Latahzan Edu">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Les Privat</h1>
                            </div>
                            <form class="user" action='/register' method="post">
                                @csrf
                                {{-- Nama Lengkap --}}
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleLastName" placeholder="Nama Lengkap" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Akhir Nama Lengkap --}}

                                {{-- Umur & Jenis Kelamin--}}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" name="umur" class="form-control form-control-user @error('umur') is-invalid @enderror" id="exampleLastName" placeholder="Umur" value="{{ old('umur') }}">
                                        @error('umur')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Jenis Kelamin</label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="P">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                      Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="L">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                    Laki-Laki
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Akhir Umur & Jenis Kelamin--}}

                                {{-- Tempat Tanggal Lahir --}}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="tempat_lahir" class="form-control form-control-user @error('tempat_lahir') is-invalid @enderror" id="exampleLastName" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" name="tanggal_lahir" class="form-control form-control-user @error('tanggal_lahir') is-invalid @enderror" id="exampleLastName" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Akhir Tempat Tanggal Lahir --}}

                                {{-- Kelas dan Alamat --}}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select name="kelas" class="form-control" style="border-radius: 40px; height: 100%">
                                            <option value="sd">SD</option>
                                            <option value="smp">SMP</option>
                                            <option value="sma/smk">SMA/SMK</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="alamat" class="form-control form-control-user @error('alamat') is-invalid @enderror" id="exampleLastName" placeholder="Alamat" value="{{ old('alamat') }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Akhir Kelas dan Almat --}}
                                
                                {{-- Email --}}
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Akhir Email --}}

                                {{-- Password --}}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" id="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" id="password" name="password_confirmation" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Repeat Password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Akhir Password --}}

                                <button class="btn btn-primary btn-user btn-block" type="submit">Daftar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/login-latahzanEdu">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src={{ asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js") }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ asset("admin/vendor/jquery-easing/jquery.easing.min.js") }}></script>

    <!-- Custom scripts for all pages-->
    <script src={{ asset("admin/js/sb-admin-2.min.js") }}></script>

</body>

</html>