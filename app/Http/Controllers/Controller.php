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
        $user = DB::table('users')->where('id', 1)->first();
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
}
