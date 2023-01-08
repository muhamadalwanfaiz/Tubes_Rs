<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;

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

    // VIEW DATA DIRI
    public function datadiris()
    {
        $user = Auth::user();
        $datadiris = Pasien::all();

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

        return view('datadiri',compact('user', 'datadiris', 'nomer'));
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
}
