@extends('layouts.main-ip')
@section('title','Hogwarts University')
    
    @section('container')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li>Admission</li>
            </ol>
            <h2>Admission</h2>

        </div>
        </section><!-- End Breadcrumbs -->

        <section id="inner-page">   
            <div class="container" style="padding: 0 50px;">

                <div class="row">
                    <h2>Sedang Berlangsung</h2>
                    <div class="col-md-6 mt-2">
                        <a href="#">
                            <div class="p-cb cb-text cb-active" style="padding: 10px 20px; border-radius:10px; background-image: linear-gradient(to right, darkblue, whitesmoke); color: white; border: 0px;">
                                <div style="font-size: 40px;" class=" cb-title mt-2"></div>
                                <div class="cb-content mt-3">
                                    <p style="color: white;">Seleksi Mandiri Jalur Ujian Tulis</p>
                                    <a href="{{ url('/admission/create-admission-utul') }}" class="btn btn-outline-light mb-3" style="border-radius: 20px; margin:0; padding: 0 10px; border: 1px solid;">
                                        <strong> Daftar </strong>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 mt-2">
                        <a href="#">
                            <div class="p-cb cb-text cb-active" style="padding: 10px 20px; border-radius:10px; background-image: linear-gradient(to right, darkred, whitesmoke); border: 0px; color: white;">
                                <div style="font-size: 40px;" class="cb-title mt-2"></div>
                                <div class="cb-content mt-3">
                                    <p style="color: white;">Seleksi Mandiri Jalur UTBK</p>
                                </div>
                                <a href="{{ url('/admission/create-admission-utbk') }}" class="btn btn-outline-light mb-3" style="border-radius: 20px; margin:0; padding: 0 10px; border: 1px solid;">
                                    <strong> Daftar </strong>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row" style="margin: 50px 0px 0px 0px; padding: 0px; border-radius: 10px">
                    <hr class="solid"></hr>
                    <div class="col-md-12">
                        <div class="grid-item">
                            <div class="widget border-box p-cb" style="cursor:default;">
                                <div class="mb-4">
                                    <h4>Status Pendaftaran</h4>
                                </div>
                                <div class="mb-4 d-flex flex-row">
                                    <form method="POST" name="form1" action="{{ url('pic-seminar/search') }}">
                                        @csrf
                                        <div class="input-group">
                                            <input name="keyword" type="text" value="" class="form-control" aria-describedby="basic-addon2" style="width: 270px;" placeholder="Kata Kunci">
                                            <div class="input-group-append">
                                                <input type="submit" style="background-color: #e7e7e7;" class="input-group-text btn-info" value="Cari" id="basic-addon2">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <thead>
                                            <tr class="text-start">
                                                <th>No.</th>
                                                <th class="text-center">Jalur Ujian</th>
                                                <th class="text-center">Program Studi Pilihan</th>
                                                <th class="text-center">Tanggal Pendaftaran</th>
                                                <th class="text-center">Status Pembayaran</th>
                                                <th class="text-center">Status Penerimaan</th>
                                            </tr>
                                        </thead>

                                        @php
                                            $no = 1;
                                        @endphp
                                        <tbody>
                                        @forelse($admissions as $admission)
                                            <tr class="text-start">
                                                <td>{{ $no++ }}</td>
                                                <td class="text-center">{{ $admission->jalur_ujian }}</td>
                                                <td class="text-center">{{ $admission->program_studi }}</td>
                                                <td class="text-center">{{ $admission->tgl_pendaftaran }}</td>
                                                @if ($admission->payment_status === 'unpaid')
                                                <td class="text-center">
                                                    <a href="{{ url('/admission/create-payment/'.$admission->id) }}">
                                                        <button class="btn btn-outline-dark mx-1 my-1" style="border-radius:20px" type="button">Upload Bukti Pembayaran</button>
                                                    </a>
                                                </td>
                                                @else ($admission->payment_status === 'paid')
                                                <td class="text-center">Sudah Terbayar</td>
                                                @endif
                                                @if ($admission->payment_status === 'unpaid')
                                                <td class="text-center">Silakan melanjutkan pembayaran</td>
                                                @elseif ($admission->payment_status === 'paid' && $admission->status === 'pending')
                                                <td class="text-center">Proses Seleksi</td>
                                                @elseif ($admission->payment_status === 'paid' && $admission->status === 'accepted')
                                                <td class="text-center">Lolos</td>
                                                @else ($admission->payment_status === 'paid' && $admission->status === 'accepted')
                                                <td class="text-center">Tidak Lolos</td>
                                                @endif
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin: 50px 0px 0px 0px; padding: 0px; border-radius: 10px">
                    <hr class="solid"></hr>
                    <div class="col-md-12">
                        <div class="grid-item">
                            <div class="widget border-box p-cb" style="cursor:default;">
                                <div class="mb-4">
                                    <h4>Riwayat Pendaftaran</h4>
                                </div>
                                <div class="mb-4 d-flex flex-row">
                                    <form method="POST" name="form1" action="{{ url('pic-seminar/search') }}">
                                        @csrf
                                        <div class="input-group">
                                            <input name="keyword" type="text" value="" class="form-control" aria-describedby="basic-addon2" style="width: 270px;" placeholder="Kata Kunci">
                                            <div class="input-group-append">
                                                <input type="submit" style="background-color: #e7e7e7;" class="input-group-text btn-info" value="Cari" id="basic-addon2">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <thead>
                                            <tr class="text-start">
                                                <th>No.</th>
                                                <th class="text-center">Jalur Ujian</th>
                                                <th class="text-center">Tanggal Pendaftaran</th>
                                                <th class="text-center">Status Penerimaan</th>
                                                <th class="text-center">Detail</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </section>
    </main><!-- End #main -->
