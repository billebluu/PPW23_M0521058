@extends('layouts.main-ip')
@section('title','Hogwart University')
    
    @section('container')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="{{url('/')}}">Home</a></li>        
			<li><a href="{{url('admission')}}">Admission</a></li>
            <li>Upload Bukti Pembayaran Biaya Pendaftaran</li>
            </ol>
            <h2>Upload Bukti Pembayaran Biaya Pendaftaran</h2>

        </div>
        </section><!-- End Breadcrumbs -->

        <section id="inner-page">   
            <div class="container" style="padding: 0 100px; min-height:50vh;">
                <div class="card">
                    <h3 class="text-center card-header">Data Pembayaran</h3>
                    <form action="{{ url('/admission/store-payment') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $admission->id }}">
                        @csrf
                        <div class="card-text grid-item p-4">
                            <div class="mb-3 form-group">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <input type="text" name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" aria-describedby="payment_method">
                                @error('payment_method')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="amount" class="form-label">Nominal Pembayaran</label>
                                <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" id="amount" aria-describedby="amount">
                                @error('amount')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                                <input type="date" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" aria-describedby="payment_date">
                                @error('payment_date')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="bukti_payment" class="form-label">Upload Bukti Pembayaran (.pdf)</label>
                                <input type="file" name="bukti_payment" class="form-control @error('bukti_payment') is-invalid @enderror" id="bukti_payment" aria-describedby="bukti_payment">
                                @error('bukti_payment')
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