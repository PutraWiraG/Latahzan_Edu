@extends('layouts.admin.app')
@section('container')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @include('layouts.admin.guru.dashboardGuru')

    </div>
    <!-- Content Row -->
    <a href="/dashboard/guru" class="btn btn-info btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-backspace"></i>
        </span>
        <span class="text">Kembali</span>
    </a>

    {{-- Detail --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Guru</h6>
        </div>
        <div class="card-body">
            
            <form action="/dashboard/guru/{{ $teacher->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $teacher->name }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Profil</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImg()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="hidden" name="oldImg" value="{{ $teacher->image }}">
                            @if ($teacher->image)
                                <img src="{{ asset('storage/'. $teacher->image) }}" class="img-preview img-fluid col-sm-5">
                            @else
                                <img class="img-preview img-fluid col-sm-5">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" class="form-control @error('umur') is-invalid @enderror" name="umur" value="{{ $teacher->umur }}" required>
                            @error('umur')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="L" {{ $teacher->jenis_kelamin == "L" ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ $teacher->jenis_kelamin == "P" ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $teacher->tempat_lahir }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Kelahiran</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"value="{{ $teacher->tanggal_lahir }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="lulusan" class="form-label">Lulusan</label>
                            <select name="lulusan" class="form-control">
                                <option value="S1" {{ $teacher->kelas == "S1" ? 'selected' : '' }}>S1</option>
                                <option value="D4" {{ $teacher->kelas == "D4" ? 'selected' : '' }}>D4</option>
                                <option value="D3" {{ $teacher->kelas == "D3" ? 'selected' : '' }}>D3</option>
                                <option value="D2" {{ $teacher->kelas == "D2" ? 'selected' : '' }}>D2</option>
                                <option value="D1" {{ $teacher->kelas == "D1" ? 'selected' : '' }}>D1</option>
                                <option value="SMA/SMK" {{ $teacher->kelas == "SMA/SMK" ? 'selected' : '' }}>SMA/SMK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $teacher->alamat }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $teacher->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
            </form>
            
        </div>
    </div>

</div>

<script>

    function previewImg(){
        
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }

    }

</script>


@endsection