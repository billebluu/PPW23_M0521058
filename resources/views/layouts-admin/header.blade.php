<div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-event"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->


            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interface
            </div> -->

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin')}}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Event Details -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-coins"></i>
                    <span>Data Pembayaran</span></a>
            </li>


            <!-- Nav Item - Event Approval Request -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-check-circle"></i>
                    <span>Data Pendaftaran</span></a>
            </li>


            <!-- Nav Item - User Details -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/data-user') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data User</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout();">
                  <i class="fas fa-fw fa-sign-out-alt"></i>
                  <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
            </li>
            
                <script>
                  function confirmLogout() {
                    if (confirm('Apakah Anda yakin ingin logout?')) {
                      document.getElementById('logout-form').submit();
                    }
                  }
                </script>
            <br><br>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        