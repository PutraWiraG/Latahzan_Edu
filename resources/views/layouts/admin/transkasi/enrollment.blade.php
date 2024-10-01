@extends('layouts.admin.app')
@section('container')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @include('layouts.admin.transkasi.dashboardEnrollment')

    </div>
    <!-- Content Row -->
    
    @if (session()->has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    
    {{-- Table Data Enrollments --}}
    <div class="card shadow mb-4 mt-2 card-table">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Enrollments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nama Guru</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $enrollment->student->name }}</td>
                                <td>{{ $enrollment->jadwal->teacher->name }}</td>
                                <td>{{ $enrollment->jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($enrollment->jadwal->waktu)->format('H:i') }}</td>
                                <td>{{ $enrollment->enrollment_date }}</td>
                                <td>{{ $enrollment->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $enrollments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>

@endsection