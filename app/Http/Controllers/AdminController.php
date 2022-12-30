<?php

namespace App\Http\Controllers;

use App\Exports\PasienExport;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    // VIEW DATA PASIEN
    public function pasiens()
    {
        $user = Auth::user();
        $pasiens = Pasien::all();

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

        return view('pasien',compact('user', 'pasiens', 'nomer'));
    }

    // ADD DATA PASIEN
    public function submit_pasien(Request $req)
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
            'message' => 'Data pasien berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pasiens')->with($notification);
    }

    // AJAX PROCESS
    public function getDataPasien($id)
    {
        $pasien = Pasien::find($id);
        return response()->json($pasien);
    }

    // UPADATE DATA PASIEN
    public function update_pasien(Request $req) 
    {
        $pasien = Pasien::find($req->get('id'));

        $validate = $req->validate([
            'kodePasien' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'umur' => 'required',
            'alamat' => 'required',
            'noHp' => 'required'
        ]);

        $pasien->kodePasien = $req->get('kodePasien');
        $pasien->nama = $req->get('nama');
        $pasien->gender = $req->get('gender');
        $pasien->umur = $req->get('umur');
        $pasien->alamat = $req->get('alamat');
        $pasien->noHp = $req->get('noHp');

        $pasien->save();

        $notification = array(
            'message' => 'Data pasien berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pasiens')->with($notification);

    }

    // DELETE DATA PASIEN
    public function delete_pasien($id)
    {
        $pasien = Pasien::find($id);

        $pasien->delete();

        $success = true;
        $message = "Data pasien berhasil dihapus";

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    // EXPORT EXCEL DATA PASIEN
    public function export()
    {
        return Excel::download(new PasienExport, 'pasien.xlsx');
    }

}
