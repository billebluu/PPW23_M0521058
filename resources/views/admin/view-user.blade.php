@extends('layouts-admin.main')
@section('title','Data User - Hogwarts University')

    
    @section('container')


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ url('admin/data-user')}}">  
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" name="keyword" value="{{ $keyword }}" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                    <!-- <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg"> -->
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
                 
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data User</h1>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <a href="{{ url('/admin/data-user/create-user') }}" style="color:black; text-decoration:underline;"><button class="btn btn-primary my-3 mx-1" style="border-radius: 5px;">+ Tambah User</button></a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" align="center">
            <thead align="center">
                    <tr align="center">
                        <th>No</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Dokumen</th>
                        <th>Manajemen</th>
                    </tr>
                </thead>
                <tbody align="center">
                    <tr align="center">
                    <?php $i = 0;?>
                    @foreach($user as $key=>$value)
                        <td>{{ $user->firstItem() + $i }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->telepon }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td class="text-center">
                        @php
                            $pasfotoFileName = basename($value->pasfoto);
                            $ijazahFileName = basename($value->ijazah);
                            $transkripNilaiFileName = basename($value->transkrip_nilai);
                        @endphp
                        <!-- Perlu menjalankan php artisan storage:link -->
                            <a href="{{ Storage::url('pasfoto/'.$pasfotoFileName) }}" target="_blank" style="color:black; text-decoration:underline;"><button class="btn btn-outline-dark my-1 mx-1" style="border-radius: 20px;">Pasfoto</button></a>
                            <a href="{{ Storage::url('ijazah/'.$ijazahFileName) }}" target="_blank" style="color:black; text-decoration:underline;"><button class="btn btn-outline-dark my-1 mx-1" style="border-radius: 20px;">Ijazah</button></a>
                            <a href="{{ Storage::url('transkrip_nilai/'.$transkripNilaiFileName) }}" target="_blank" style="color:black; text-decoration:underline;"><button class="btn btn-outline-dark my-1 mx-1" style="border-radius: 20px;">Transkrip Nilai</button></a>
                        </td>
                        <td>
                        <a href="{{ url('/admin/data-user/more-user/'.$value->id) }}" style="color:black; text-decoration:underline;"><button class="btn btn-secondary my-1 mx-1" style="border-radius: 5px;">More</button></a>
                        <a href="{{ url('/admin/data-user/edit-user/'.$value->id) }}" style="color:black; text-decoration:underline;"><button class="btn btn-primary my-1 mx-1" style="border-radius: 5px;">Edit</button></a>
                            <form action="{{ route('user.delete', $value->id) }}" method="POST" style="display: inline;">
                            @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1 my-1" style="border-radius:5px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data user ini?')">Hapus</button>
                            </form>
                        </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="entry-info">
                Showing {{ $user->firstItem() }} to {{ $user->lastItem() }} of {{ $user->total() }} entries
            </div>
            <div class="float-right">
            @if ($user->previousPageUrl())
                <a href="{{ $user->previousPageUrl() }}" class="btn btn-primary">Previous</a>
            @endif

            @if ($user->nextPageUrl())
                <a href="{{ $user->nextPageUrl() }}" class="btn btn-primary">Next</a>
            @endif
        </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


    

@endsection