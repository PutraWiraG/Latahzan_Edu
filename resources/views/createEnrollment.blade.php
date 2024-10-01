<x-layouts>
    
    <div class="row box">
        <div class="col-md-4 d-flex justify-content-center">
            <img class="logoLatahzan" src="{{ asset('img/latahzanEdu.jpg') }}" alt="Latahzan Edu">
        </div>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex flex-column">
                <div class="col">
                    <h1 class="heading-1" style="font-weight: bold">Daftar Les Privat</h1>
                    <p class="deskripsi">Jangan lewatkan kesempatan berharga ini! Segera daftarkan diri Anda untuk les privat dan tingkatkan kemampuan Anda dengan bimbingan langsung dari pengajar berpengalaman. Dengan berbagai jadwal fleksibel yang tersedia, Anda bisa memilih waktu yang paling cocok untuk belajar tanpa mengganggu aktivitas sehari-hari. Bergabunglah sekarang, dan ambil langkah pertama menuju kesuksesan akademis dan pribadi Anda! Daftar hari ini dan rasakan manfaat dari pembelajaran yang disesuaikan dengan kebutuhan Anda.</p>
                </div>
            </div>
        </div>
    </div>
    
    <section id="keunggulan" style="margin-top: 100px;">
        <div class="row mt-5">
            <div class="col d-flex flex-column align-items-center text-keunggulan">
                <h2 style="font-weight: bold">Selesaikan Pendaftaran diBawah Ini!!</h2>
            </div>
        </div>
        <div class="row d-flex flex-column align-items-center mt-5">
            <div class="col-md-6 d-flex flex-column align-items-start text-keunggulan">
                <p>Biodata Siswa</p>
                <table>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td>{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{ $student->kelas }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $student->alamat }}</td>
                    </tr>
                </table>
            </div>
            <div class="col d-flex justify-content-center mt-3">
                <hr style="border: 1px solid black; width: 50%;">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-start text-keunggulan">
                <p>Biodata Guru</p>
                <table>
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
            </div>
            <div class="col d-flex justify-content-center mt-3">
                <hr style="border: 1px solid black; width: 50%;">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-start text-keunggulan">
                <p>Pilihan Jadwal</p>
                <table>
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
            </div>
            <div class="col-md-6 d-flex flex-column align-items-start text-keunggulan mt-3">
                <form action="/enrollments" method="post">
                    @csrf
                    <div class="mb-3">
                        <p>Pesan</p>
                        <textarea name="pesan" cols="30" rows="10" class="form-control" style="width: 120%">Hallo Bapak/Ibu Saya Ingin Daftar Les Privat Sesuai Jadwal Yang Saya Pilih, Mohon diRespon Bapak/Ibu!!
                        </textarea>
                    </div>
                    <input type="text" value={{ $student->id }} name="id_siswa" hidden>
                    <input type="text" value={{ $jadwal->id }} name="id_jadwal" hidden>
                    <button type="button" class="btn btn-danger">Ajukan</button>
                </form>
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
