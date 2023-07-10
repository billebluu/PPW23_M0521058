@extends('layouts-admin.main')
@section('title','Dashboard Admin')

    
    @section('container')

     <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="mt-4 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row d-flex flex-column">

</div>
<!-- /.container-fluid -->
<div class="container" style="padding-top:50px; align-items:center;">
                <div class="card">
                    <h4 class="text-center card-header">Edit Status Penerimaan Mahasiswa</h4>

                    <form action="{{ url('/admin/data-user/store-admission-status') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $admissions->users_id }}">
                        <div class="card-text grid-item p-4">
                            <div class="mb-3 form-group">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $admissions->name) }}" class="form-control" id="name" aria-describedby="name" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $admissions->email) }}" class="form-control" id="email" aria-describedby="email" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="tempat_lahir" class="form-label">Status Penerimaan</label>
                                <input type="text" name="status"value="{{ old('status', $admissions->status) }}" class="form-control @error('status') is-invalid @enderror" id="status" aria-describedby="status">
                                @error('status')
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
</div>
<!-- End of Main Content -->

    

@endsection