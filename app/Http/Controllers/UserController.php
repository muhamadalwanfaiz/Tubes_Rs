<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Pembayaran;
use App\Models\User;
use App\Mail\SendingEmail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Informasi;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }


    /* 
    // VIEW DATA DIRI 
    */
    public function datadiris()
    {
        $user = Auth::user();
        $datadiris = Pasien::all();
        $dokters = Dokter::all();
        $kunjungans = Kunjungan::all();

        // Kode Pasien Otomatis
        $cek = Pasien::count();
        if ($cek == 0) {
            $urut = 101;
            $nomer = 'KP' . $urut;
            // dd($nomer);
        } else {
            $ambil = Pasien::all()->last();
            $urut = (int)substr($ambil->kodePasien, -3) + 1;
            $nomer = 'KP' . $urut;
        }

        return view('datadiriUser',compact('user', 'kunjungans', 'dokters', 'datadiris', 'nomer'));
    }

    // ADD DATA DIRI
    public function submit_datadiri(Request $req)
    {
        $validate = $req->validate([
            'kodePasien' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'noHp' => 'required',
        ]);

        $pasien = new Pasien;
        $pasien->kodePasien = $req->get('kodePasien');
        $pasien->nama = $req->get('nama');
        $pasien->gender = $req->get('gender');
        $pasien->umur = $req->get('umur');
        $pasien->alamat = $req->get('alamat');
        $pasien->noHp = $req->get('noHp');

        $pasien->save();
        $notification = array(
            'message' => 'Data Diri berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('user.pendaftarans')->with($notification);
    }


    /* 
    // VIEW PENDAFTARAN 
    */
    public function pendaftarans()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $kodepasiens = Pasien::orderBy('id','desc')->first();

        $user = Auth::user();
        $pendaftarans = Kunjungan::all();

        return view('pendaftaranUser',compact('user','pendaftarans','pasiens','dokters','kodepasiens'));
    }

    // ADD PENDAFTARAN
    public function submit_pendaftaran(Request $req)
    {
        $validate = $req->validate([
            'pasiens_id' => 'required',
            'dokters_id' => 'required',
            'keterangan' => 'required',
        ]);

        $pendaftaran = new Kunjungan;
        $pendaftaran->pasiens_id = $req->get('pasiens_id');
        $pendaftaran->dokters_id = $req->get('dokters_id');
        $pendaftaran->keterangan = $req->get('keterangan');

        $pendaftaran->save();
        $notification = array(
            'message' => 'pendaftaran berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('user.pembayarans')->with($notification);
    }


    /*
    // VIEW PEMBAYARAN 
    */
    public function pembayarans()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $kodepasiens = Pasien::orderBy('id','desc')->first();
        $idkunjungan = Kunjungan::orderBy('id','desc')->first();
        $idpembayaran = Pembayaran::orderBy('id','desc')->first();

        $user = Auth::user();
        $pendaftarans = Kunjungan::all();

        return view('pembayaranUser',compact('user','pendaftarans','pasiens','dokters','kodepasiens', 'idpembayaran', 'idkunjungan'));
    }

    // ADD PEMBAYARAN
    public function submit_pembayaran(Request $req)
    {
        $validate = $req->validate([
            'kunjungans_id' => 'required',
            'noRek' => 'required',
            'jmlPembayaran' => 'required',
            'buktiPembayaran' => 'required',
        ]);

        $pembayaran = new Pembayaran;
        $pembayaran->kunjungans_id = $req->get('kunjungans_id');
        $pembayaran->noRek = $req->get('noRek');
        $pembayaran->jmlPembayaran = $req->get('jmlPembayaran');
        if($req->hasFile('buktiPembayaran')){
            $extension = $req->file('buktiPembayaran')->extension();

            $filename = 'bkt_bayar'.time().'.'. $extension;

            $req->file('buktiPembayaran')->storeAs('public/bkt_bayar', $filename);

            $pembayaran->buktiPembayaran = $filename;
        }

        $pembayaran->save();
        $notification = array(
            'message' => 'Data pembayaran berhasil ditambahkan',
            'alert-type' => 'success'
        );

        $user = User::orderBy('id','desc')->first();
        $data = [
            'line1' => 'Terimakasih Telah melakukan Pendaftaran Mohon Di tunggu Untuk Pemeriksaanya',
            'action' => 'Ok',
            'line2' => 'Terima Kasih,'
        ];

        $user->notify(new Informasi($data));

        return redirect()->route('user.pembayarans')->with($notification);
    }
}
