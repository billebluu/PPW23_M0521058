<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Admission;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }
    
    public function view_admission()
    {
        $userId = Auth::id();
        $admissions = Admission::where('user_id', $userId)->get();

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

        $userId = Auth::id();

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
            'user_id' => $userId,
            'program_studi' => $request->program_studi,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'poster' => $sertif_utbk_path,
            'jalur_ujian' => 'UTBK'
        ]);

        return redirect('/admission')->with('message', 'Data pendaftaran berhasil disimpan.');
    }

    public function store_admission_utul(Request $request)
    {
        $userId = Auth::id();

        $this->validate($request, [
            'program_studi' => 'required',
            'tgl_pendaftaran' => 'required',
        ]);

        Admission::create([
            'user_id' => $userId,
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
            $admission->payment_status = 'pending';
            $admission->save();
    
            return redirect('/admission')->with('message', 'Bukti pembayaran berhasil disimpan.');
        } else {
            return redirect('/admission')->with('message', 'Bukti pembayaran gagal disimpan.');
        }
    }

    public function dashboard_admin()
    {
        $total_user = User::count();
        $total_peserta_utbk = Admission::where('jalur_ujian', 'UTBK')->count();
        $total_peserta_utul = Admission::where('jalur_ujian', 'Ujian Tulis')->count();
        $total_unverified_payment = Admission::where('payment_status', 'pending')->count();
        return view('admin.dashboard', compact('total_user', 'total_peserta_utbk', 'total_peserta_utul', 'total_unverified_payment'));
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

    public function more_user($id){
        $user = User::find($id);
        return view('admin.more-user', compact('user'));
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

    public function view_pendaftaran(Request $request)
    {
        $keyword = $request->keyword;
        
        $pendaftaran = DB::table('admission')
            ->join('users', 'admission.user_id', '=', 'users.id')
            ->select('admission.*', 'users.name', 'users.email')
            ->where(function ($query) use ($keyword) {
                $query->where('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);
            
        $pendaftaran->withPath('data-pendaftaran');
        $pendaftaran->appends($request->all());

        return view('admin.view-pendaftaran', compact('pendaftaran', 'keyword'));
    }

    public function view_pembayaran(Request $request)
    {
        $keyword = $request->keyword;
        
        $pembayaran = DB::table('payments')
        ->join('admission', 'payments.admission_id', '=', 'admission.id')
        ->join('users', 'admission.user_id', '=', 'users.id')
        ->select('payments.*', 'admission.*', 'users.name', 'users.email')
        ->where(function ($query) use ($keyword) {
            $query->where('users.name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('users.email', 'LIKE', '%' . $keyword . '%');
        })
        ->paginate(10);
        
    $pembayaran->withPath('data-pembayaran');

    return view('admin.view-pembayaran', compact('pembayaran', 'keyword'));
    }

    public function edit_admission_status($id)
    {
        $admission = Admission::join('users', 'admission.user_id', '=', 'users.id')
        ->where('admission.id', $id)
        ->select('admission.*', 'users.name', 'users.email')
        ->first();

        return view('admin.edit-admission-status', compact('admission'));
    }

    public function store_admission_status(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'status' => 'required',
        ]);

        $id = $request->input('id');
        $admission = Admission::find($id);

        if($admission){
            $admission->status = $request->input('status');
            $admission->save();

            return redirect('/admin/data-user')->with('success', 'Status penerimaan berhasil diperbarui.');
        }

    }

    public function verif_pembayaran(Request $request)
    {
        $admission_id = $request->input('admission_id');

        $admission = Admission::find($admission_id);
        if ($admission) {
            $admission->payment_status = 'paid';
            $admission->save();
    
            return redirect('/admin/data-pembayaran')->with('message', 'Pembayaran berhasil diverifikasi.');
        } else {
            return redirect('/admin/data-pembayaran')->with('message', 'Pembayaran gagal diverifikasi.');
        }
    }

}
