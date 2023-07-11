@extends('layouts-admin.main')
@section('title','Dashboard Admin')

    
    @section('container')
 <!-- Begin Page Content -->
 <div class="container-fluid">

 <div class="row">
 <div class="col mb-4 my-4">
    <div class="card shadow h-100 py-5" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url({{asset('/img/admin.jpg')}}); background-position: center; background-size: cover;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <h3 class="text-center font-weight-bold text-light text-uppercase mb-1">
                        SELAMAT DATANG {{auth()->user()->name}}!</h3>
                </div>
            </div>
        </div>
    </div>
</div>
 </div>


<!-- Page Heading -->
<div class="mt-4 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>


<!-- Content Row -->
<div class="row d-flex flex-column">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            TOTAL USER</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_user }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            TOTAL PENDAFTAR SELEKSI MANDIRI JALUR UTBK</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_peserta_utbk }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            TOTAL PENDAFTAR SELEKSI MANDIRI JALUR UJIAN TULIS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_peserta_utul }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-pencil-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card Example -->
    <div class="col mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            PEMBAYARAN BELUM DIVERIVIKASI</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_unverified_payment }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">


    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

    

@endsection