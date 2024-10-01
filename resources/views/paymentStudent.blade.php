<x-layouts>
    
    <div class="row box">
        <div class="col-md-4 d-flex justify-content-center">
            <img class="logoLatahzan" src="{{ asset('img/latahzanEdu.jpg') }}" alt="Latahzan Edu">
        </div>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex flex-column">
                <div class="col">
                    <h1 class="heading-1" style="font-weight: bold">Segera Selesaikan Pembayaran!!</h1>
                    <p class="deskripsi">Segera selesaikan pendaftaran Anda dan rasakan pengalaman belajar yang seru dan efektif bersama Latahzan Edu! Dengan bimbingan pengajar yang profesional dan jadwal yang fleksibel, Anda dapat meningkatkan pemahaman di bidang yang Anda minati. Jangan lewatkan kesempatan untuk bergabung dan maksimalkan potensi belajar Anda bersama kami!</p>
                </div>
            </div>
        </div>
    </div>
    
    <section id="keunggulan" style="margin-top: 100px;">
        <div class="row mt-5">
            <div class="col d-flex flex-column align-items-center text-keunggulan">
                <h2 style="font-weight: bold">Halaman Payment</h2>
            </div>
        </div>
        <div class="row d-flex flex-column align-items-center mt-5">
          <div class="col-md-6 d-flex flex-column align-items-start text-keunggulan">
              <table>
                  <tr>
                      <td>Tanggal Pendaftaran</td>
                      <td>:</td>
                      <td>{{ $enrollment->enrollment_date }}</td>
                  </tr>
                  <tr>
                      <td>Nama Guru</td>
                      <td>:</td>
                      <td>{{ $teacher->name }}</td>
                  </tr>
                  <tr>
                      <td>Alamat Guru</td>
                      <td>:</td>
                      <td>{{ $teacher->alamat }}</td>
                  </tr>
                  <tr>
                      <td>Jadwal Les</td>
                      <td>:</td>
                      <td>{{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                  </tr>
              </table>
          </div>
          <div class="col d-flex justify-content-center mt-1">
              <hr style="border: 1px solid black; width: 50%;">
          </div>
      </div>
      <div class="row d-flex flex-column align-items-center">
        <div class="col-md-6">
          <p>Pilih Bulan Yang Akan diBayar:</p>
          <form action="/payment" method="post">
            @csrf
            <div class="row">
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Januari" {{ $currentMonth > 1 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Januari
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Februari" {{ $currentMonth > 2 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Februari
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Maret" {{ $currentMonth > 3 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Maret
                </label>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="April" {{ $currentMonth > 4 ? 'disabled' : '' }} onclick="calculateTotal()">
                  April
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Mei" {{ $currentMonth > 5 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Mei
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Juni" {{ $currentMonth > 6 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Juni
                </label>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Juli" {{ $currentMonth > 7 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Juli
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Agustus" {{ $currentMonth > 8 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Agustus
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="September" {{ $currentMonth > 9 ? 'disabled' : '' }} onclick="calculateTotal()">
                  September
                </label>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Oktober" {{ $currentMonth > 10 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Oktober
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="November" {{ $currentMonth > 11 ? 'disabled' : '' }} onclick="calculateTotal()">
                  November
                </label>
              </div>
              <div class="col">
                <label>
                  <input type="checkbox" name="bulan" value="Desember" {{ $currentMonth > 12 ? 'disabled' : '' }} onclick="calculateTotal()">
                  Desember
                </label>
              </div>
            </div>
            <p id="totalHarga" class="mt-3">Total Harga: Rp 0</p>
            <input type="number" id="harga" name="totalHarga" hidden>
            <input type="number" id="totalPilihan" name="totalPilihan" hidden>
            <input type="number" name="id_enrollment" value={{ $enrollment->id }} hidden>

            <button type="submit" class="btn btn-primary mt-2">Checkout</button>
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

      <script>
        function calculateTotal() {
            // Harga per checkbox
            const pricePerCheckbox = 40000;

            // Mendapatkan semua checkbox yang dipilih
            const checkedCheckboxes = document.querySelectorAll('input[name="bulan"]:checked');

            // Menghitung total harga
            const total = checkedCheckboxes.length * pricePerCheckbox;

            // Menampilkan total harga
            document.getElementById('totalHarga').innerText = `Total Harga: Rp ${total.toLocaleString()}`;
            document.getElementById('harga').value = total;
            document.getElementById('totalPilihan').value = checkedCheckboxes.length;
        }
    </script>
    
</x-layouts>
