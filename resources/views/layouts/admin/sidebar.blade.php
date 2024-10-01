<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <div class='sticky-top'>
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/page-admin">
            <div class="sidebar-brand-text mx-3">Latahzan Edu</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="fas fa-home"></i>
                <span>Home</span></a>
        </li>

        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item {{ Request::is('dashboard/siswa*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/siswa">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Siswa</span>
            </a>
        </li>
        
        <li class="nav-item {{ Request::is('dashboard/guru*') || Request::is('dashboard/jadwal*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/guru">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Guru</span>
            </a>
        </li>
        
        <li class="nav-item {{ Request::is('dashboard/admin*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/admin">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Admin</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('dashboard/enrollment*') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard/enrollment">
                <i class="fas fa-fw fa-luggage-cart"></i>
                <span>Enrollments</span>
            </a>
        </li>

    </div>
</ul>