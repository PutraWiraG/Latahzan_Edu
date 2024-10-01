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
            <h6 class="m-0 font-weight-bold text-primary">Detail Guru</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col d-flex justify-content-center">
                    
                    @if ($teacher->image)
                        <img class="img-profile" src={{ asset('storage/' . $teacher->image) }} style="width: 200px; border-radius: 20px">
                    @else
                        <img class="img-profile rounded-circle" src={{ asset("admin/img/undraw_profile.svg") }} style="width: 200px">
                    @endif

                </div>
            </div>

            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $teacher->name }}</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td>{{ $teacher->umur }} Tahun</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $teacher->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir</td>
                    <td>:</td>
                    <td>{{ $teacher->tempat_lahir }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $teacher->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>Lulusan</td>
                    <td>:</td>
                    <td>{{ $teacher->lulusan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $teacher->alamat }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $teacher->email }}</td>
                </tr>
            </table>
            <div class="mt-3">
                <a href="/dashboard/guru/{{ $teacher->id }}/edit" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Data</a>
                <form action="/dashboard/guru/{{ $teacher->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i> Hapus Data</button>
                </form>
            </div>
            
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    {{-- Enrollments --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrollments</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills card-header-pills mb-2">
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('dashboard/guru/'. $teacher->id .'/Pending') ? 'active' : '' }}" href="/dashboard/guru/{{ $teacher->id }}/Pending">Pending</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('dashboard/guru/'. $teacher->id .'/Confirmed') ? 'active' : '' }}" href="/dashboard/guru/{{ $teacher->id }}/Confirmed">Confirmed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('dashboard/guru/'. $teacher->id .'/Active') ? 'active' : '' }}" href="/dashboard/guru/{{ $teacher->id }}/Active">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('dashboard/guru/'. $teacher->id .'/Ajuan_Cancelled') ? 'active' : '' }}" href="/dashboard/guru/{{ $teacher->id }}/Ajuan_Cancelled">Ajuan Cancelled</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('dashboard/guru/'. $teacher->id .'/Cancelled') ? 'active' : '' }}" href="/dashboard/guru/{{ $teacher->id }}/Cancelled">Cancelled</a>
                </li>
            </ul>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Siswa</th>
                            <th>Jadwal</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->id }}</td>
                                <td>{{ $enrollment->student->name }}</td>
                                <td>{{ $enrollment->jadwal->hari }} | {{ \Carbon\Carbon::parse($enrollment->jadwal->waktu)->format('H:i') }}</td>
                                <td>{{ $enrollment->enrollment_date }}</td>
                                <td>{{ $enrollment->status }}</td>
                                <td>
                                    @if ($enrollment->status == 'Active')
                                        
                                        <a href="/enrollments/{{ $enrollment->id }}/edit" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
                                    
                                    @elseif($enrollment->status == 'Ajuan Cancelled')
                                        @if ($enrollment->cancel_teacher == false)
                                            <a href="/enrollments/{{ $enrollment->id }}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>    
                                        @endif
                                    @elseif($enrollment->status != 'Cancelled')
                                    
                                        <a href="/enrollments/{{ $enrollment->id }}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>  
            </div>                    
        </div>
    </div>

</div>

@endsection