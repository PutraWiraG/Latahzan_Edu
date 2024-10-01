<x-layouts>
    
    <div class="row box">
        <div class="col-md-4 d-flex justify-content-center">
            <img class="logoLatahzan" src="{{ asset('img/latahzanEdu.jpg') }}" alt="Latahzan Edu">
        </div>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex flex-column">
                <div class="col">
                    <h1 class="heading-1" style="font-weight: bold">Status Pendaftaran</h1>
                    <p class="deskripsi">Status pendaftaran mencerminkan kondisi pendaftaran siswa dalam les privat, seperti "Pending" untuk pendaftaran yang menunggu konfirmasi, "Confirmed" untuk siswa yang telah disetujui oleh guru, "Active" untuk siswa yang telah melakukan pembayaran dan sedang mengikuti les, dan "Canceled" untuk pendaftaran yang dibatalkan. Status ini membantu memantau dan mengelola proses pembelajaran dengan lebih efektif.</p>
                </div>
            </div>
        </div>
    </div>
    
    <section id="keunggulan" style="margin-top: 100px;">
        <div class="row d-flex flex-column align-items-center mt-5">
            <div class="col d-flex flex-column align-items-center text-keunggulan">
                <h2 style="font-weight: bold">Status Pendaftaran</h2>
            </div>
            <div class="col d-flex justify-content-center mt-1">
                <hr style="border: 1px solid black; width: 50%;">
            </div>
        </div>


        <div class="container">
            <ul class="nav nav-pills card-header-pills mb-2">
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('enrollments/status/Pending') ? 'active' : '' }}" href="/enrollments/status/Pending">Pending</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('enrollments/status/Confirmed') ? 'active' : '' }}" href="/enrollments/status/Confirmed">Confirmed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('enrollments/status/Active') ? 'active' : '' }}" href="/enrollments/status/Active">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('enrollments/status/Ajuan_Cancelled') ? 'active' : '' }}" href="/enrollments/status/Ajuan_Cancelled">Ajuan Cancelled</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('enrollments/status/Cancelled') ? 'active' : '' }}" href="/enrollments/status/Cancelled">Cancelled</a>
                </li>
            </ul>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Jadwal</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $enrollment->jadwal->teacher->name }}</td>
                                    <td>{{ $enrollment->jadwal->hari }} | {{ \Carbon\Carbon::parse($enrollment->jadwal->waktu)->format('H:i') }}</td>
                                    <td>{{ $enrollment->enrollment_date }}</td>
                                    <td>{{ $enrollment->pesan }}</td>
                                    <td>
                                        {{ $enrollment->status }}
                                    </td>
                                    <td>
                                        @if ($enrollment->status == 'Confirmed')
                                            <a href="/enrollments/{{ $enrollment->id }}/edit" class="btn btn-warning"><i class="fas fa-credit-card"></i></a>
                                        @elseif($enrollment->status == 'Active')
                                            <a href="/enrollments/{{ $enrollment->id }}/edit" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
                                        @elseif($enrollment->status == 'Ajuan Cancelled')
                                            @if($enrollment->cancel_siswa == false)
                                              <a href="/enrollments/{{ $enrollment->id }}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>            
            </div>
        </div>
    </section>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#0099ff"
          fill-opacity="1"
          d="M0,192L26.7,208C53.3,224,107,256,160,229.3C213.3,203,267,117,320,117.3C373.3,117,427,203,480,229.3C533.3,256,587,224,640,218.7C693.3,213,747,235,800,256C853.3,277,907,299,960,282.7C1013.3,267,1067,213,1120,197.3C1173.3,181,1227,203,1280,186.7C1333.3,171,1387,117,1413,90.7L1440,64L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"
        ></path>
      </svg>

    <!-- Footer -->
    <footer class="text-white text-center pb-4 pt-1">
        <div class="container">
          <div class="row">
            <div class="col-md-4 mb-3">
              <img src="{{ asset('img/latahzanEdu.jpg') }}" alt="Latahzan Edu" class="mb-3" />
              <p>CopyRight Latahzan Edu 2023</p>
            </div>
            <div class="col-md-4 mb-3 text-start">
              <h2>Latahzan Edu</h2>
              <p>Bimbingan Belajar</p>
              <h3>Media Sosial</h3>
              <a href="https://www.instagram.com/putra_wir22/" class="text-white"><i class="bi bi-instagram"></i></a>
              <a href="https://github.com/PutraWiraG" class="text-white"><i class="bi bi-github"></i></a>
              <a href="https://www.linkedin.com/in/putra-dwi-wira-gardha-yuniahans-729024159/" class="text-white"><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="col-md-4 mb-3 text-start">
              <h3>Kontak dan Alamat</h3>
              <a href="" class="text-white"><i class="bi bi-envelope"></i> putra22wir@gmail.com</a><br />
              <i class="bi bi-map text-white"></i> Wonocolo Gg 8 no 37 Surabaya
            </div>
          </div>
        </div>
      </footer>
      <!-- Akhir Footer -->  

</x-layouts>
