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
    <a href="/dashboard/guru/create" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Tambah Data Guru</span>
    </a>
    <a href="/dashboard/jadwal" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-calendar-week"></i>
        </span>
        <span class="text">Lihat Jadwal Guru</span>
    </a>
    
    @if (session()->has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    
    {{-- Table Data Siswa --}}
    <div class="card shadow mb-4 mt-2 card-table">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Lulusan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->jenis_kelamin }}</td>
                                <td>{{ $teacher->umur }}</td>
                                <td>{{ $teacher->lulusan }}</td>
                                <td>
                                    <a href="/dashboard/guru/{{ $teacher->id }}/Pending" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="/dashboard/guru/{{ $teacher->id }}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="/dashboard/guru/{{ $teacher->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $teachers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>

@endsection