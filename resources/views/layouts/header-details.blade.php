<!-- ======= Header ======= -->
<header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

    <table>
                    <tr> 
                        <td rowspan="2" width="12%">
                            <img width="70px" src="{{asset('/img/logo-hogwart.png')}}">
                        </td>
                        <td rowspan="2">
                            <h2 class="logo text-light" ><a href="{{url('/')}}"><b>Hogwarts <br> University</b></a></h2>
                        </td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" width="100%"></table>

                <nav id="navbar" class="navbar">
        <ul>
        @auth
         
          <!-- <li>
         
            <form action="/dashboard" method="post" class="d-flex" role="search">
              @csrf
                <input class="form-control me-2" type="text" name="keyword" size="20" style="padding-right:50px"autofocus autocomplete="off" placeholder="Masukkan Keyword" aria-label="Search">
                <button class="search2" type="submit" name="search2">Search</button>
            </form>
          </li> -->
          <li><a class="nav-link scrollto" href="{{url('/home')}}">Home</a></li>
          <li><a class="nav-link scrollto" href="{{url('/admission')}}">Admission</a></li>
          <li><a class="nav-link scrollto" href="{{url('/admin')}}">Admin Dashboard</a></li>
          <li class="dropdown" style="color:white;"><a href="#"><span>{{ auth()->user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{url('profile')}}">Lihat Profil</a></li>
              <!-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> -->
              <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout();">
                    {{ __('Logout') }}
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

            
        
             
            </ul>
          </li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        @endauth
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->