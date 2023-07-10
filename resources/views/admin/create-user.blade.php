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
                    <h4 class="text-center card-header">Data User</h4>
                    <form action="{{ url('/admin/data-user/store-user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-text grid-item p-4">
                            <div class="mb-3 form-group">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name">
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email">
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="password" class="form-label">Password (min. 8 Karakter)</label>
                                <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="password">
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" aria-describedby="tempat_lahir">
                                @error('tempat_lahir')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" aria-describedby="tgl_lahir">
                            @error('tgl_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="Male" >Male</option>
                                <option value="Female" >Female</option>
                            </select>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="4"></textarea>
                            @error('alamat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" name="telepon"  class="form-control @error('telepon') is-invalid @enderror" id="telepon" aria-describedby="telepon">
                            @error('telepon')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan"  class="form-control @error('kewarganegaraan') is-invalid @enderror" id="kewarganegaraan" aria-describedby="kewarganegaraan">
                            @error('kewarganegaraan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="riwayat_sekolah" class="form-label">Riwayat Sekolah</label>
                            <input type="text" name="riwayat_sekolah"  class="form-control @error('riwayat_sekolah') is-invalid @enderror" id="riwayat_sekolah" aria-describedby="riwayat_sekolah">
                            @error('riwayat_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah"  class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" aria-describedby="nama_sekolah">
                            @error('nama_sekolah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" class="form-control" id="jurusan">
                                <option value="MIPA" >MIPA</option>
                                <option value="IPS" >IPS</option>
                            </select>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                            <input type="text" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" aria-describedby="tahun_lulus">
                            @error('tahun_lulus')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="pasfoto" class="form-label">Pasfoto (.png, .jpg, .jpeg)</label>
                            <input type="file" name="pasfoto" class="form-control-file @error('pasfoto') is-invalid @enderror" id="pasfoto" aria-describedby="pasfoto">
                            @error('pasfoto')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="ijazah" class="form-label">Ijazah (.pdf)</label>
                            <input type="file" name="ijazah" class="form-control-file @error('ijazah') is-invalid @enderror" id="ijazah" aria-describedby="ijazah">
                            @error('ijazah')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label for="transkrip_nilai" class="form-label">Transkrip Nilai (.pdf)</label>
                            <input type="file" name="transkrip_nilai" class="form-control-file @error('transkrip_nilai') is-invalid @enderror" id="transkrip_nilai" aria-describedby="transkrip_nilai">
                            @error('transkrip_nilai')
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