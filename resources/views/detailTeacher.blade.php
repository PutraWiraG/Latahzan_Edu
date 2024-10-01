<x-layouts>
    
    <div class="row box">
        <div class="col-md-4 d-flex justify-content-center">
            @if ($teacher->image)
                <img src={{ asset('storage/' . $teacher->image) }} class="rounded mx-auto my-auto d-block" style="width: 130px">
            @else
                <img src={{ asset("admin/img/undraw_profile.svg") }} class="rounded mx-auto my-auto d-block" style="width: 200px">
            @endif
        </div>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex flex-column">
                <div class="col">
                    <h1 class="heading-1" style="font-weight: bold">{{ $teacher->name }}</h1>
                    <p>{{ $teacher->alamat }} | {{ $teacher->email }}</p>
                    <p class="deskripsi">Ayo, temukan waktu terbaik untuk memulai sesi belajar Anda bersama pengajar pilihan! Dengan berbagai jadwal yang tersedia, Anda bisa menyesuaikan waktu yang paling cocok untuk kebutuhan belajar. Pilihlah jadwal yang pas dan mari bersama-sama menyalakan semangat belajar, mencapai tujuan, dan meraih prestasi baru setiap harinya. Jadwal sudah siap, kini saatnya Anda menentukan langkah pertama menuju kesuksesan!</p>
                </div>
            </div>
        </div>
    </div>
    
    <section id="keunggulan" style="margin-top: 100px;">
        <div class="row mt-5">
            <div class="col d-flex flex-column align-items-center text-keunggulan">
                <h2 style="font-weight: bold">Jadwal Yang Tersedia</h2>
                <p>Pilih jadwal yang berstatus "Kosong"!!</p>
            </div>
        </div>

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
                                    @if ($jadwal->status == 'Kosong')
                                        
                                        <a href="/enrollments/create/{{ $jadwal->id }}" class="btn" style="width: 100%; color: white; background-color: red">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                    
                                    @elseif($jadwal->status == 'Booking')

                                        <button class="btn" style="background-color: yellow; color: black; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>

                                    @else

                                        <button class="btn" style="background-color: green; color: white; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>
                                    
                                    @endif
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
                                    @if ($jadwal->status == 'Kosong')
                                        
                                        <a href="/enrollments/create/{{ $jadwal->id }}" class="btn" style="width: 100%; color: white; background-color: red">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                    
                                    @elseif($jadwal->status == 'Booking')

                                        <button class="btn" style="background-color: yellow; color: black; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>

                                    @else

                                        <button class="btn" style="background-color: green; color: white; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>
                                    
                                    @endif
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
                                    @if ($jadwal->status == 'Kosong')
                                        
                                        <a href="/enrollments/create/{{ $jadwal->id }}" class="btn" style="width: 100%; color: white; background-color: red">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                    
                                    @elseif($jadwal->status == 'Booking')

                                        <button class="btn" style="background-color: yellow; color: black; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>

                                    @else

                                        <button class="btn" style="background-color: green; color: white; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>
                                    
                                    @endif
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
                                    @if ($jadwal->status == 'Kosong')
                                        
                                        <a href="/enrollments/create/{{ $jadwal->id }}" class="btn" style="width: 100%; color: white; background-color: red">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                    
                                    @elseif($jadwal->status == 'Booking')

                                        <button class="btn" style="background-color: yellow; color: black; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>

                                    @else

                                        <button class="btn" style="background-color: green; color: white; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>
                                    
                                    @endif
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
                            @if ($jadwal->hari == 'Jumat')
                                <div class="col-md-6 mt-2">
                                    @if ($jadwal->status == 'Kosong')
                                        
                                        <a href="/enrollments/create/{{ $jadwal->id }}" class="btn" style="width: 100%; color: white; background-color: red">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</a>
                                    
                                    @elseif($jadwal->status == 'Booking')

                                        <button class="btn" style="background-color: yellow; color: black; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>

                                    @else

                                        <button class="btn" style="background-color: green; color: white; width: 100%; cursor: default;">{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }} | {{ $jadwal->status }}</button>
                                    
                                    @endif
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
