@extends('layouts.admin.app')
@section('container')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Siswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        {{-- @include('layouts.live.student.dashboardStudent') --}}

    </div>

    @livewire('dashboard-student')

</div>

@endsection
