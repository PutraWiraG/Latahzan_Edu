<x-layouts>
    
    <div class="row box">
        <div class="col-md-4 d-flex justify-content-center">
            <img class="logoLatahzan" src="{{ asset('img/latahzanEdu.jpg') }}" alt="Latahzan Edu">
        </div>
        <div class="col d-flex justify-content-start">
            <div class="row d-flex flex-column">
                <div class="col">
                    <h1 class="heading-1" style="font-weight: bold">Jadikan Belajarmu Lebih Seru</h1>
                    <h1 class="heading-2" style="font-weight: bold;">Bersama Latahzan Edu</h1>

                    @if (Str::length(Auth::guard('student')->user()) > 0)

                        <p class="deskripsi">Selamat Datang, <span style="color: black; font-weight: bold;">{{ Auth::guard('student')->user()->name }}</span>. Hari ini sulit, besok akan lebih baik. Tetaplah belajar dan lihat bagaimana dunia Anda berubah. Selamat Belajar!!</p>

                    @elseif(Str::length(Auth::guard('user')->user()) > 0 || Str::length(Auth::guard('teacher')->user()) > 0)
                        
                        <p class="deskripsi">Selamat Datang, <span style="color: black; font-weight: bold;">{{ Auth::guard('user')->user()->name }}</span>. Hari ini sulit, besok akan lebih baik. Tetaplah belajar dan lihat bagaimana dunia Anda berubah. Selamat Belajar!!</p>    
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-warning" href="/dashboard">Dashboard</a>
                            </div>
                        </div>

                    @else
                        <p class="deskripsi">LatahzanEdu merupakan lembaga les privat yang diminati banyak siswa siswi khususnya di Surabaya. Banyak guru yang kompeten dibidangnya serta pembelajaran yang modern dan sesuai dengan kurikulum terbaru di Indonesia. Segera daftar dengan menekan tombol dibawah ini!!</p>
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-daftar" href="/register">Daftar</a>
                                <a class="btn btn-login" href="/login-latahzanEdu">Login</a>
                            </div>
                        </div>
                    @endif
                    {{-- @auth
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-warning" href="/dashboard">Dashboard</a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-daftar" href="/register">Daftar</a>
                                <a class="btn btn-login" href="/login-latahzanEdu">Login</a>
                            </div>
                        </div>
                    @endauth --}}
                </div>
            </div>
        </div>
    </div>
    
    <section id="keunggulan" style="margin-top: 100px;">
        <div class="row mt-5 mb-3">
            <div class="col d-flex flex-column align-items-center text-keunggulan">
                <h2 style="font-weight: bold">Belajar Lebih Seru Bersama Latahzan Edu</h2>
                <p>Temukan Keunggulan Belajar Privat di Latahzan Edu</p>
            </div>
        </div>

        <div class="row" style="margin-bottom: 200px">
            <div class="col d-flex justify-content-center">
                <div class="card card-keunggulan shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <button class="btn btn-keunggulan p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img class="keunggulan" src="{{ asset('img/fitur/1.png') }}"></button>
                                <button class="btn btn-keunggulan ms-3 p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img class="keunggulan" src="{{ asset('img/fitur/2.png') }}"></button>
                                <button class="btn btn-keunggulan ms-3 p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img class="keunggulan" src="{{ asset('img/fitur/3.png') }}"></button>
                                <button class="btn btn-keunggulan ms-3 p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><img class="keunggulan" src="{{ asset('img/fitur/4.png') }}"></button>        
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body" style="max-width: 520px">
                                    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>   
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="youtube">
        <div class="row pb-5 mt-5 mb-5 flex-responsive" style="background-color: #0099ff; color: white;">
            <div class="col mt-5 d-flex justify-content-center spasi">
                <iframe width="90%" height="400" class="box-yt"
                src="https://www.youtube.com/embed/DsqMUJ7rbXg">
                </iframe>
            </div>
            <div class="col me-5 mt-5">
                <h2 class="mb-3">Kenapa Latahzan Edu?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi id facere tenetur a, doloribus dicta officiis molestiae natus, fuga impedit velit placeat! Illum odio odit fugiat doloribus, provident modi numquam, repudiandae ad perferendis praesentium aperiam! Hic provident est exercitationem rem.</p>
            </div>
        </div>
    </section>

    <section id="guru" style="margin-top: 100px;">
        <div class="row mt-5 mb-4">
            <div class="col d-flex flex-column align-items-center text-keunggulan">
                <h2 style="font-weight: bold">Profile Guru</h2>
                <p>Pilih guru privatmu sesuai yang kamu inginkan!!</p>
            </div>
        </div>

        <div class="row d-flex justify-content-center" style="margin-bottom: 200px">
            @foreach ($teachers as $teacher)
                <div class="col-md-4 mb-3">
                    <div class="card pt-1 pb-2 shadow-sm" style="height: 400px">
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
                        <a href="/jadwal_teacher/{{ $teacher->id }}" class="btn btn-primary mx-auto" style="width: 200px">Lihat Jadwal</a>
                    </div>
                </div>
            @endforeach
            @if(Str::length(Auth::guard('user')->user()) > 0 || Str::length(Auth::guard('teacher')->user()) > 0 || Str::length(Auth::guard('student')->user()) > 0)
                {{ $teachers->links('pagination::bootstrap-5') }}
            @endif

            {{-- {{ $teachers->links('pagination::bootstrap-5') }} --}}
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
              <img src="img/latahzanEdu.jpg" alt="Latahzan Edu" class="mb-3 img-footer"/>
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
