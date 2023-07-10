<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Admission;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function view_admission()
    {
        $user = DB::table('users')->where('id', 32)->first();
        $admissions = Admission::where('user_id', $user->id)->get();

        $admissions = $admissions->sortByDesc('tgl_pendaftaran');

        return view('admission.view-admission', compact('admissions'));
    }

    public function create_admission_utbk(){
        return view('admission.create-admission-utbk');
    }
    
    public function create_admission_utul(){
        return view('admission.create-admission-utul');
    }

    public function store_admission_utbk(Request $request)
    {

        $this->validate($request, [
            'program_studi' => 'required',
            'tgl_pendaftaran' => 'required',
            'sertif_utbk' => 'required|file|mimes:pdf',
        ]);
        

        $sertif_utbk_path = null;

        if ($request->hasFile('sertif_utbk')) {
            $sertif_utbk = $request->file('sertif_utbk');

            if (!is_null($sertif_utbk)) {
                $sertif_utbk_path = $sertif_utbk->store('public/sertif_utbk');
            }
        }

        Admission::create([
            'user_id' => 1,
            'program_studi' => $request->program_studi,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'poster' => $sertif_utbk_path,
            'jalur_ujian' => 'UTBK'
        ]);

        return redirect('/admission')->with('message', 'Data pendaftaran berhasil disimpan.');
    }

    public function store_admission_utul(Request $request)
    {

        $this->validate($request, [
            'program_studi' => 'required',
            'tgl_pendaftaran' => 'required',
        ]);

        Admission::create([
            'user_id' => 1,
            'program_studi' => $request->program_studi,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'jalur_ujian' => 'Ujian Tulis',
        ]);

        return redirect('/admission')->with('message', 'Data pendaftaran berhasil disimpan.');
    }

    public function create_payment($id){
        $admission = Admission::find($id);
        return view('admission.create-payment', compact('admission'));
    }

    public function store_payment(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
            'payment_method' => 'required',
            'payment_date' => 'required',
            'amount' => 'required',
            'bukti_payment' => 'required|file|mimes:pdf',
        ]);
        
        $id = $request->input('id');

        if ($request->hasFile('bukti_payment')) {
            $bukti_payment = $request->file('bukti_payment');
            $bukti_payment_path = $bukti_payment->store('public/bukti_payment');

            $payment = new Payment();
            $payment->admission_id = $id;
            $payment->payment_method = $request->payment_method;
            $payment->payment_date = $request->payment_date;
            $payment->amount = $request->amount;
            $payment->bukti_payment = $bukti_payment_path;
            $payment->save();
        }

        $admission = Admission::find($id);
        if ($admission) {
            $admission->payment_status = 'paid';
            $admission->save();
    
            return redirect('/admission')->with('message', 'Bukti pembayaran berhasil disimpan.');
        } else {
            return redirect('/admission')->with('message', 'Bukti pembayaran gagal disimpan.');
        }
    }

    public function dashboard_admin()
    {
        $total_user = User::count();
        return view('admin.dashboard', compact('total_user'));
    }

    public function view_user(Request $request)
    {
        $keyword = $request->keyword;
        $user = User::where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%');
        })
        ->paginate(10);
        
        $user->withPath('data-user');
        $user->appends($request->all());

        return view('admin.view-user',compact('user','keyword'));
    }

    public function delete_user($id){
        $user = User::findOrFail($id);

        // Hapus data pembicara
        $user->delete();

        return redirect()->back()->with('message', 'Data user berhasil dihapus.');
    }

    public function edit_user($id){
        $user = User::find($id);
        return view('admin.edit-user', compact('user'));
    }

    public function store_user_edited(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'kewarganegaraan' => 'required',
            'riwayat_sekolah' => 'required',
            'nama_sekolah' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required',
            'pasfoto' => 'nullable|image|mimes:png,jpg,jpeg',
            'ijazah' => 'nullable|file|mimes:pdf',
            'transkrip_nilai' => 'nullable|file|mimes:pdf',
        ]);

        $id = $request->input('id');
        $user = User::find($id);

        $pasfoto_path = null;
        $ijazah_path = null;
        $transkrip_nilai_path = null;

        if ($request->hasFile('pasfoto')) {
            $pasfoto = $request->file('pasfoto');
            $pasfoto_path = $pasfoto->store('public/pasfoto');
        }

        if ($request->hasFile('ijazah')) {
            $ijazah = $request->file('ijazah');
            $ijazah_path = $ijazah->store('public/ijazah');
        }
        
        if ($request->hasFile('transkrip_nilai')) {
            $transkrip_nilai = $request->file('transkrip_nilai');
            $transkrip_nilai_path = $transkrip_nilai->store('public/transkrip_nilai');
        }

        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->tempat_lahir = $request->input('tempat_lahir');
            $user->tgl_lahir = $request->input('tgl_lahir');
            $user->gender = $request->input('gender');
            $user->alamat = $request->input('alamat');
            $user->telepon = $request->input('telepon');
            $user->kewarganegaraan = $request->input('kewarganegaraan');
            $user->riwayat_sekolah = $request->input('riwayat_sekolah');
            $user->nama_sekolah = $request->input('nama_sekolah');
            $user->jurusan = $request->input('jurusan');
            $user->tahun_lulus = $request->input('tahun_lulus');
            $user->pasfoto = $pasfoto_path;
            $user->ijazah = $ijazah_path;
            $user->transkrip_nilai = $transkrip_nilai_path;
            $user->save();

            // Tampilkan pesan sukses atau alihkan pengguna ke halaman lain
            return redirect('/admin/data-user')->with('success', 'Status peserta berhasil diperbarui.');
        } else {
            // Tampilkan pesan error jika id seminar tidak ditemukan
            return redirect('/admin/data-user')->with('error', 'Gagal memperbarui status peserta.');
        }
    }

    public function create_user(){
        return view('admin.create-user');
    }

    public function store_user(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'kewarganegaraan' => 'required',
            'riwayat_sekolah' => 'required',
            'nama_sekolah' => 'required',
            'jurusan' => 'required',
            'tahun_lulus' => 'required',
            'pasfoto' => 'nullable|image|mimes:png,jpg,jpeg',
            'ijazah' => 'nullable|file|mimes:pdf',
            'transkrip_nilai' => 'nullable|file|mimes:pdf',
        ]);

        $pasfoto_path = null;
        $ijazah_path = null;
        $transkrip_nilai_path = null;

        if ($request->hasFile('pasfoto')) {
            $pasfoto = $request->file('pasfoto');
            $pasfoto_path = $pasfoto->store('public/pasfoto');
        }

        if ($request->hasFile('ijazah')) {
            $ijazah = $request->file('ijazah');
            $ijazah_path = $ijazah->store('public/ijazah');
        }
        
        if ($request->hasFile('transkrip_nilai')) {
            $transkrip_nilai = $request->file('transkrip_nilai');
            $transkrip_nilai_path = $transkrip_nilai->store('public/transkrip_nilai');
        }

        $password = bcrypt($request->input('password'));

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $password;
            $user->tempat_lahir = $request->input('tempat_lahir');
            $user->tgl_lahir = $request->input('tgl_lahir');
            $user->gender = $request->input('gender');
            $user->alamat = $request->input('alamat');
            $user->telepon = $request->input('telepon');
            $user->kewarganegaraan = $request->input('kewarganegaraan');
            $user->riwayat_sekolah = $request->input('riwayat_sekolah');
            $user->nama_sekolah = $request->input('nama_sekolah');
            $user->jurusan = $request->input('jurusan');
            $user->tahun_lulus = $request->input('tahun_lulus');
            $user->pasfoto = $pasfoto_path;
            $user->ijazah = $ijazah_path;
            $user->transkrip_nilai = $transkrip_nilai_path;
            $user->save();

            // Tampilkan pesan sukses atau alihkan pengguna ke halaman lain
            return redirect('/admin/data-user')->with('success', 'Data peserta berhasil ditambahkan.');
    }
}
