<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Kunjungan;

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

        return redirect()->route('user.datadiris')->with($notification);
    }

    /* 
    // VIEW PENDAFTARAN 
    */
    public function pendaftarans()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();

        $user = Auth::user();
        $pendaftarans = Kunjungan::all();

        return view('pendaftaranUser',compact('user','pendaftarans','pasiens','dokters'));
    }

    // AJAX PROCESS
    public function getPasienPendaftaran($id)
    {
        $pasien = Pasien::find($id);
        return response()->json($pasien);
    }

    // ADD PENDAFTARAN
    public function submit_pendaftaran(Request $req)
    {
        $pasien = Pasien::find($req->get('id'))->last();
        $dokter = Dokter::all();

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

        return redirect()->route('user.datadiris')->with($notification);
    }
}
