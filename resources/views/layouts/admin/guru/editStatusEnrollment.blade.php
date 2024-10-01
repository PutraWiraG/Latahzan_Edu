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

    {{-- Card --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Status Enrollment</h6>
        </div>
        <div class="card-body">
            <form action="/enrollments/{{ $enrollment->id }}" method="post">
                @csrf
                @method('PUT')

                <p style="font-weight: bold;">Biodata Siswa</p>
                <table class="mb-2">
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                            @if ($student->jenis_kelamin == 'L')
                                Laki-Laki
                            @else
                                Perempuan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $student->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{ $student->kelas }}</td>
                    </tr>
                </table>

                <p style="font-weight: bold;">Biodata Guru</p>
                <table class="mb-2">
                    <tr>
                        <td>Nama Guru</td>
                        <td>:</td>
                        <td>{{ $teacher->name }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                            @if ($teacher->jenis_kelamin == 'L')
                                Laki-Laki
                            @else
                                Perempuan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $teacher->alamat }}</td>
                    </tr>
                </table>

                <p style="font-weight: bold;">Jadwal</p>
                <table class="mb-2">
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
                
                @if ($enrollment->status == 'Active' || $enrollment->status == 'Ajuan Cancelled')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kelas" class="form-label" style="font-weight: bold;">Status</label>
                                <input type="text" class="form-control" value="Ajuan Cancelled" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kelas" class="form-label" style="font-weight: bold;">Pesan</label>
                                <textarea name="pesan" cols="30" rows="10" class="form-control" style="width: 120%">Berikan Alasan Pengajuan Pembatalan!!</textarea>
                            </div>
                        </div>
                    </div>

                    <input type="text" value="{{ $enrollment->id }}" name="id_enrollment" hidden>
                    <input type="text" value="Ajuan Cancelled" name="status" hidden>
                    <button type="submit" class="btn btn-danger mt-2">Ajukan</button>
                @else
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kelas" class="form-label" style="font-weight: bold;">Status</label>
                                <select name="status" class="form-control">
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kelas" class="form-label" style="font-weight: bold;">Pesan</label>
                                <textarea name="pesan" cols="30" rows="10" class="form-control" style="width: 120%">Ajuan di Setujui, Silahkan Selesaikan Pendaftaran!!</textarea>
                            </div>
                        </div>
                    </div>

                    <input type="text" value="{{ $enrollment->id }}" name="id_enrollment" hidden>
                    <button type="submit" class="btn btn-primary mt-2">Respon Ajuan</button>
                @endif

            </form>
        </div>
    </div>

</div>

@endsection