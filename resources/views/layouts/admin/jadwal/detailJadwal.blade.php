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
    <a href="/dashboard/jadwal" class="btn btn-info btn-icon-split">
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

    {{-- Detail --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Guru</h6>
        </div>
        <div class="card-body">
            <div class="row d-flex flex-column mb-3">
                <div class="col d-flex justify-content-center">
                    
                    @if ($teacher->image)
                        <img class="img-profile" src={{ asset('storage/' . $teacher->image) }} style="width: 200px; border-radius: 20px">
                    @else
                        <img class="img-profile rounded-circle" src={{ asset("admin/img/undraw_profile.svg") }} style="width: 200px">
                    @endif

                </div>
                <div class="col d-flex justify-content-center mt-1">
                    <p style="font-weight: bold;">{{ $teacher->name }} | {{ $teacher->alamat }} | {{ $teacher->email }}</p>
                </div>
                <div class="col d-flex justify-content-center mt-1">
                    <hr style="border: 1px solid black; width: 50%;">
                </div>
                <div class="col d-flex justify-content-center mt-1">
                    <a href="/dashboard/jadwal/create/{{ $teacher->id }}" class="btn btn-primary">Atur Jadwal</a>
                </div>
            </div>

            <div class="row d-flex flex-column">
                <div class="col d-flex justify-content-center">
                    <div class="row d-flex flex-column">
                        @if($teacher->jadwal->isEmpty())
                            <div class="col">
                                <h3 style="color: red;">Upss Anda Belum Mengatur Jadwal Anda!!</h3>
                            </div>
                            <div class="col">
                                <p>Segera atur jadwal anda agar profil anda dapat ditampilkan didepan siswa....</p>
                            </div>
                        @else
                            <div class="col">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-5">
                                        <div class="card mb-3 shadow-sm" style="height: 170px;">
                                            <div class="card-body">
                                              <h5 class="card-title text-center">Senin</h5>
                                              @php
                                                  $senin = false; 
                                              @endphp
                                              <div class="row">
                                                @foreach($teacher->jadwal as $jadwal)
                                                    @if ($jadwal->hari == 'Senin')
                                                        <div class="col-md-6 mt-2">
                                                            <a href="/dashboard/jadwal/{{ $jadwal->id }}/edit" class="btn" style="width: 140px; color: white; background-color: {{ $jadwal->status == 'Kosong' ? 'red' : 'green' }}">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                                        </div>    
                                                        @php
                                                            $senin = true;
                                                        @endphp 
                                                    @endif
                                                @endforeach
                                              </div>
                                              @if (!$senin)

                                                <p style="font-weight: bold; color: red;">Jadwal Tidak Tersedia!</p>
                                                
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card text-center mb-3 shadow-sm" style="height: 170px;">
                                            <div class="card-body">
                                              <h5 class="card-title">Selasa</h5>
                                              @php
                                                  $selasa = false; 
                                              @endphp
                                              <div class="row">
                                                @foreach($teacher->jadwal as $jadwal)
                                                    @if ($jadwal->hari == 'Selasa')
                                                        <div class="col-md-6 mt-2">
                                                            <a href="/dashboard/jadwal/{{ $jadwal->id }}/edit" class="btn" style="width: 140px; color: white; background-color: {{ $jadwal->status == 'Kosong' ? 'red' : 'green' }}">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                                        </div>    
                                                        @php
                                                            $selasa = true;
                                                        @endphp 
                                                    @endif
                                                @endforeach
                                              </div>
                                              @if (!$selasa)

                                                <p style="font-weight: bold; color: red;">Jadwal Tidak Tersedia!</p>
                                                  
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card text-center mb-3 shadow-sm" style="height: 170px;">
                                            <div class="card-body">
                                              <h5 class="card-title">Rabu</h5>
                                              @php
                                                  $rabu = false; 
                                              @endphp
                                              <div class="row">
                                                @foreach($teacher->jadwal as $jadwal)
                                                    @if ($jadwal->hari == 'Rabu')
                                                        <div class="col-md-6 mt-2">
                                                            <a href="/dashboard/jadwal/{{ $jadwal->id }}/edit" class="btn" style="width: 140px; color: white; background-color: {{ $jadwal->status == 'Kosong' ? 'red' : 'green' }}">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                                        </div>    
                                                        @php
                                                            $rabu = true;
                                                        @endphp 
                                                    @endif
                                                @endforeach
                                              </div>
                                              @if (!$rabu)

                                                <p style="font-weight: bold; color: red;">Jadwal Tidak Tersedia!</p>
                                                  
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card text-center mb-3 shadow-sm" style="height: 170px;">
                                            <div class="card-body">
                                              <h5 class="card-title">Kamis</h5>
                                              @php
                                                  $kamis = false; 
                                              @endphp
                                              <div class="row">
                                                @foreach($teacher->jadwal as $jadwal)
                                                    @if ($jadwal->hari == 'Kamis')
                                                        <div class="col-md-6 mt-2">
                                                            <a href="/dashboard/jadwal/{{ $jadwal->id }}/edit" class="btn" style="width: 140px; color: white; background-color: {{ $jadwal->status == 'Kosong' ? 'red' : 'green' }}">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                                        </div>    
                                                        @php
                                                            $kamis = true;
                                                        @endphp 
                                                    @endif
                                                @endforeach
                                              </div>
                                              @if (!$kamis)

                                                <p style="font-weight: bold; color: red;">Jadwal Tidak Tersedia!</p>
                                                  
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card text-center mb-3 shadow-sm" style="height: 170px;">
                                            <div class="card-body">
                                              <h5 class="card-title">Jum'at</h5>
                                              @php
                                                  $jumat = false; 
                                              @endphp
                                              <div class="row">
                                                @foreach($teacher->jadwal as $jadwal)
                                                    @if ($jadwal->hari == 'jumat')
                                                        <div class="col-md-6 mt-2">
                                                            <a href="/dashboard/jadwal/{{ $jadwal->id }}/edit" class="btn" style="width: 140px; color: white; background-color: {{ $jadwal->status == 'Kosong' ? 'red' : 'green' }}">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                                        </div>    
                                                        @php
                                                            $jumat = true;
                                                        @endphp 
                                                    @endif
                                                @endforeach
                                              </div>
                                              @if (!$jumat)

                                                <p style="font-weight: bold; color: red;">Jadwal Tidak Tersedia!</p>
                                                  
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</div>

@endsection