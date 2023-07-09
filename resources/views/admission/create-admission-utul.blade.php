@extends('layouts.main-ip')
@section('title','SeminarKu')
    
    @section('container')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="{{url('/')}}">Home</a></li>        
			<li><a href="{{url('admission')}}">Admission</a></li>
            <li>Seleksi Mandiri Jalur Ujian Tulis</li>
            </ol>
            <h2>Daftar Seleksi Mandiri Jalur Ujian Tulis</h2>

        </div>
        </section><!-- End Breadcrumbs -->

        <section id="inner-page">   
            <div class="container" style="padding: 0 100px; min-height:50vh;">
                <div class="card">
                    <h3 class="text-center card-header">Data Pendaftaran</h3>
                    <form action="{{ url('/admission/store-admission-utul') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-text grid-item p-4">
                            <div class="mb-3 form-group">
                                <label for="program_studi" class="form-label">Program Studi</label>
                                <input type="text" name="program_studi" class="form-control @error('program_studi') is-invalid @enderror" id="program_studi" aria-describedby="program_studi">
                                @error('program_studi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="tgl_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                                <input type="date" name="tgl_pendaftaran" class="form-control @error('tgl_pendaftaran') is-invalid @enderror" id="tgl_pendaftaran" aria-describedby="tgl_pendaftaran">
                                @error('tgl_pendaftaran')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- @endsection -->