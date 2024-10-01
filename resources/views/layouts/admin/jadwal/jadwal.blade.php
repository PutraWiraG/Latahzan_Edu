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
    <a href="/dashboard/guru" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-backspace"></i>
        </span>
        <span class="text">Data Guru</span>
    </a>
    
    
    {{-- Table Data Siswa --}}
   <div class="row mt-3">
    @foreach ($teachers as $teacher)
        <div class="col-md-4 mb-3">
            <div class="card pt-1 pb-2" style="height: 400px">
                <div class="card-img d-flex justify-content-center align-items-center" style="height: 200px">
                    @if ($teacher->image)
                        <img src={{ asset('storage/' . $teacher->image) }} class="rounded mx-auto my-auto d-block" style="width: 130px">
                    @else
                        <img src={{ asset("admin/img/undraw_profile.svg") }} class="rounded mx-auto my-auto d-block" style="width: 200px">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $teacher->name }}</h5>
                    <p class="card-text">Alamat Guru : {{ $teacher->alamat }}</p>
                </div>
                <a href="/dashboard/jadwal/{{ $teacher->id }}" class="btn btn-primary mx-auto" style="width: 200px">Lihat Jadwal</a>
            </div>
        </div>
    @endforeach
    {{ $teachers->links('pagination::bootstrap-5') }}
   </div>

</div>

@endsection