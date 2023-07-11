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
                        <input type="hidden" name="id" value="{{ $admission->id }}">
                        <div class="card-text grid-item p-4">
                            <div class="mb-3 form-group">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('status', $admission->name) }}" class="form-control" id="name" aria-describedby="name" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $admission->email) }}" class="form-control" id="email" aria-describedby="email" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="riwayat_sekolah" class="form-label">Riwayat Sekolah</label>
                                <input type="riwayat_sekolah" name="riwayat_sekolah" value="{{ old('riwayat_sekolah', $admission->riwayat_sekolah) }}" class="form-control" id="riwayat_sekolah" aria-describedby="riwayat_sekolah" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="jalur_ujian" class="form-label">Jalur Ujian</label>
                                <input type="jalur_ujian" name="jalur_ujian" value="{{ old('jalur_ujian', $admission->jalur_ujian) }}" class="form-control" id="jalur_ujian" aria-describedby="jalur_ujian" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $admission->email) }}" class="form-control" id="email" aria-describedby="email" disabled>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="status" class="form-label">Status Penerimaan</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                    <option value="pending" {{ old('status', $admission->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option class="font-weight-bold text-success" value="accepted" {{ old('status', $admission->status) === 'accepted' ? 'selected' : '' }}>Lolos</option>
                                    <option class="font-weight-bold text-danger" value="rejected" {{ old('status', $admission->status) === 'rejected' ? 'selected' : '' }}>Tidak Lolos</option>
                                </select>
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