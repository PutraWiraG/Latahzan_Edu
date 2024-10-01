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
    <a href="/dashboard/jadwal/{{ $teacher->id }}" class="btn btn-info btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-backspace"></i>
        </span>
        <span class="text">Kembali</span>
    </a>

    @if (session()->has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Jadwal Guru</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/jadwal" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $teacher->name }}" readonly>
                    <input type="hidden" class="form-control" value="{{ $teacher->id }}" name="id_guru">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Hari</label>
                            <select name="hari" class="form-control">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Waktu</label>
                            <input type="time" class="form-control" name="waktu">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="Kosong">Kosong</option>
                                <option value="Full">Full</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
        </div>
    </div>

</div>

@endsection