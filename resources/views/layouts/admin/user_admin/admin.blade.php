@extends('layouts.admin.app')
@section('container')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang Admin</h1>
    </div>

    {{-- Detail --}}
    <div class="card shadow mb-4 mt-2 card-input">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
        </div>
        <div class="card-body">

            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="/dashboard/admin/{{ $user->id }}/edit" class="btn btn-warning mt-3"><i class="fas fa-edit"></i> Edit Data</a>
                    </td>
                </tr>
            </table>
            
        </div>
    </div>

</div>

@endsection