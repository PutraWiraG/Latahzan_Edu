<div>

    {{-- Dashboard --}}
    <div class="row">
        <!-- Jumlah Murid -->
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_students }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                            {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Murid Laki-Laki -->
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Siswa Laki-Laki
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $male_count }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Murid Perempuan -->
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Siswa Perempuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $female_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Akhir Dashboard --}}

    @if (session()->has('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($detail)
        {{-- Detail --}}
        <div class="card shadow mb-4 mt-2 card-input">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Siswa</h6>
            </div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col d-flex justify-content-center">
                        
                        @if ($studentDetail->image)
                            <img class="img-profile" src={{ asset('storage/' . $studentDetail->image) }} style="width: 200px; border-radius: 20px">
                        @else
                            <img class="img-profile rounded-circle" src={{ asset("admin/img/undraw_profile.svg") }} style="width: 200px">
                        @endif

                    </div>
                </div>

                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $studentDetail->name }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>{{ $studentDetail->umur }} Tahun</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $studentDetail->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td>{{ $studentDetail->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $studentDetail->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{ $studentDetail->kelas }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $studentDetail->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $studentDetail->email }}</td>
                    </tr>
                </table>
                <div class="mt-3">
                    <a wire:click="cancel()" class="btn btn-info"><i class="fas fa-backspace"></i> Kembali</a>
                    <a wire:click="edit({{ $studentDetail->id }})" class="btn btn-warning"><i class="fas fa-edit"></i> Edit Data</a>
                    <button wire:click="konfirmasiDelete({{ $studentDetail->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-trash-alt"></i> Hapus Data</button>
                </div>
            </div>
        </div>
    @else

        {{-- Card --}}
        <div class="card shadow mb-4 mt-2 card-input">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Input Data Siswa</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="image" class="form-label">Foto Profil</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" wire:model="image">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                @if ($imagePreview)
                                    @if ($updateData)
                                        
                                        @if ($preview)

                                            <img src="{{ $imagePreview }}" class="img-fluid col-sm-5">
                                        @else
                                            <img src="{{ asset('storage/' . $imagePreview) }}" class="img-fluid col-sm-5">
                                        
                                        @endif
                                    
                                    @else

                                        <img src="{{ $imagePreview }}" class="img-fluid col-sm-5">

                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" class="form-control @error('umur') is-invalid @enderror" wire:model="umur">
                                @error('umur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select wire:model="jenis_kelamin" class="form-control">
                                    <option></option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" wire:model="tempat_lahir">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Kelahiran</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" wire:model="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select wire:model="kelas" class="form-control">
                                    <option></option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" wire:model="alamat">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if ($updateData == true)
                        <button type="button" class="btn btn-warning" wire:click="update()">Edit Data</button>
                        <button type="button" class="btn btn-danger" wire:click="cancel()">Batal</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="store()">Tambahkan</button>
                    @endif
                </form>
            </div>
        </div>
        

        {{-- Table Data Siswa --}}
        <div class="card shadow mb-4 mt-2 card-table">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
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
                                <th>Kelas</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student)
                                <tr>
                                    <td>{{ $students->firstItem() + $key }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->jenis_kelamin }}</td>
                                    <td>{{ $student->umur }}</td>
                                    <td>{{ $student->kelas }}</td>
                                    <td>
                                        <a wire:click="showDetail({{ $student->id }})" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a wire:click="edit({{ $student->id }})" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        <a wire:click="konfirmasiDelete({{ $student->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $students->links() }}
                </div>
            </div>
        </div>

    @endif


    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Yakin Akan Menghapus Data Ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-primary" wire:click="delete()" data-bs-dismiss="modal">Iya</button>
            </div>
          </div>
        </div>
      </div>
</div>
