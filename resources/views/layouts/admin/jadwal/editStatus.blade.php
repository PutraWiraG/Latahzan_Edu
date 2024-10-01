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

    {{-- Card --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Jadwal Guru</h6>
        </div>
        <div class="card-body">
            <form action="/dashboard/jadwal/{{ $jadwal->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <table>
                        <tr>
                            <td>Nama Guru</td>
                            <td>:</td>
                            <td>{{ $teacher->name }}</td>
                        </tr>
                        <tr>
                            <td>Hari</td>
                            <td>:</td>
                            <td>{{ $jadwal->hari }}</td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="Kosong" {{ $jadwal->status == "Kosong" ? 'selected' : '' }}>Kosong</option>
                                <option value="Full" {{ $jadwal->status == "Full" ? 'selected' : '' }}>Full</option>
                            </select>
                            <input type="hidden" class="form-control" value="{{ $teacher->id }}" name="id_guru">
                            <input type="hidden" class="form-control" value="{{ $jadwal->hari }}" name="hari">
                            <input type="hidden" class="form-control" value="{{ $jadwal->waktu }}" name="waktu">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Edit</button>
            </form>
        </div>
    </div>

</div>

@endsection