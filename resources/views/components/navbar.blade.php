<nav class="navbar navbar-expand-lg pt-3 pb-3 fixed-top" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="/">LatahzanEdu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          @if (Str::length(Auth::guard('student')->user()) > 0 || Str::length(Auth::guard('user')->user()) > 0 )
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if (Str::length(Auth::guard('student')->user()) > 0 )
                    {{ Auth::guard('student')->user()->name }}
                @elseif (Str::length(Auth::guard('user')->user()) > 0)
                    {{ Auth::guard('user')->user()->name }}
                @endif
              </a>
              <ul class="dropdown-menu">
                @if (Str::length(Auth::guard('user')->user()) > 0 || Str::length(Auth::guard('teacher')->user()) > 0)
                    
                  <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window-reverse"></i> Dashboard</a></li>

                @else

                  <li><a class="dropdown-item" href="/enrollments/status/Pending"><i class="bi bi-layout-text-window-reverse"></i> Status Pendaftaran</a></li>

                @endif
                <li>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="/login-latahzanEdu"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
</nav>