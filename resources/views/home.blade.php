@extends('layouts.main')
@section('title','Hogwarts University')

    
    @section('container')

        <section id="hero" class="d-flex align-items-center">

        <div class="container">
        <div class="row">
            <div class="px-4 pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h1 class="text-center">Selamat Datang di Hogwarts!</h1>
            <h2 class="px-5 text-center">Sebuah komunitas pemelajar berkelanjutan, warga negara yang bertanggung jawab,
                dan pemenang atas keberhasilan diri sendiri.</h2>
                <div class="d-grid gap-3 d-md-flex justify-content-center">
                    <a href="{{ url('/admission') }}" class="btn btn-outline-light center-content">Student Admission</a>
                    <a href="{{ url('/') }}" class="btn btn-light center-content">Hogwarts Hari Ini</a>
                </div>
            </div>
        </div>
        </div>

        </section><!-- End Hero -->
    @endsection